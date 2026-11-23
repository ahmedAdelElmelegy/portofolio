<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactMessageRequest;
use App\Http\Requests\UpdateContactMessageRequest;
use App\Http\Resources\ContactMessageResource;
use App\Models\ContactMessage;
use App\Traits\ApiResponse;

class ContactMessageController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $messages = ContactMessage::latest()->get();

        return $this->successResponse(
            ContactMessageResource::collection($messages),
            'messages fetched successfully',
            200
        );
    }

    public function store(StoreContactMessageRequest $request)
    {
        $message = ContactMessage::create($request->validated());

        return $this->successResponse(
            new ContactMessageResource($message),
            'message sent successfully',
            201
        );
    }

    public function show(ContactMessage $contactMessage)
    {
        return $this->successResponse(
            new ContactMessageResource($contactMessage),
            'message fetched successfully',
            200
        );
    }

    public function update(UpdateContactMessageRequest $request, ContactMessage $contactMessage)
    {
        $contactMessage->update($request->validated());

        return $this->successResponse(
            new ContactMessageResource($contactMessage),
            'message status updated successfully',
            200
        );
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return $this->successResponse(
            null,
            'message deleted successfully',
            200
        );
    }
}
