<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateVideoSectionRequest;
use App\Models\VideoContentItem;
use App\Models\VideoSection;
use Illuminate\Support\Facades\Storage;

class VideoSectionAdminController extends Controller
{
    public function edit()
    {
        $videoSection = VideoSection::with('items')->first();

        if (! $videoSection) {
            $videoSection = VideoSection::create([
                'badge' => 'Interactive Showcase',
                'title' => 'Get To Know Me & Connect',
                'subtitle' => 'Watch this short interactive presentation highlighting who I am and my direct contacts.',
                'video_path' => 'videos/intro.mp4',
                'is_active' => true,
                'sort_order' => 1,
            ]);
        }

        return view('admin.video-section.edit', compact('videoSection'));
    }

    public function update(UpdateVideoSectionRequest $request)
    {
        $videoSection = VideoSection::first() ?? new VideoSection;
        $data = $request->validated();

        if ($request->hasFile('video')) {
            if ($videoSection->video_path && Storage::disk('public')->exists($videoSection->video_path)) {
                // Don't delete if it's the default seeded one unless replaced with a new custom path
                if ($videoSection->video_path !== 'videos/intro.mp4') {
                    Storage::disk('public')->delete($videoSection->video_path);
                }
            }
            $data['video_path'] = $request->file('video')->store('videos', 'public');
        }

        if ($request->hasFile('cover_image')) {
            if ($videoSection->cover_image && Storage::disk('public')->exists($videoSection->cover_image)) {
                Storage::disk('public')->delete($videoSection->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('videos/covers', 'public');
        }

        $videoSection->fill([
            'badge' => $data['badge'] ?? null,
            'title' => $data['title'],
            'subtitle' => $data['subtitle'] ?? null,
            'is_active' => (bool) ($data['is_active'] ?? false),
            'video_path' => $data['video_path'] ?? $videoSection->video_path ?? 'videos/intro.mp4',
            'cover_image' => $data['cover_image'] ?? $videoSection->cover_image,
        ])->save();

        // Sync items
        $submittedItems = $request->input('items', []);
        $keepIds = [];

        foreach ($submittedItems as $index => $itemData) {
            if (empty(trim($itemData['title'] ?? ''))) {
                continue;
            }

            $itemId = $itemData['id'] ?? null;
            $attributes = [
                'video_section_id' => $videoSection->id,
                'title' => $itemData['title'],
                'value' => $itemData['value'] ?? null,
                'url' => $itemData['url'] ?? null,
                'icon' => $itemData['icon'] ?? 'fa-solid fa-link',
                'badge' => $itemData['badge'] ?? null,
                'sort_order' => isset($itemData['sort_order']) && is_numeric($itemData['sort_order']) ? (int) $itemData['sort_order'] : $index + 1,
            ];

            if ($itemId) {
                $item = VideoContentItem::where('video_section_id', $videoSection->id)->find($itemId);
                if ($item) {
                    $item->update($attributes);
                    $keepIds[] = $item->id;

                    continue;
                }
            }

            $created = $videoSection->items()->create($attributes);
            $keepIds[] = $created->id;
        }

        // Delete items that were removed by the admin
        $videoSection->items()->whereNotIn('id', $keepIds)->delete();

        return back()->with('success', 'Video Showcase section updated successfully.');
    }
}
