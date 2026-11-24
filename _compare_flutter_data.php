<?php

echo "=== 1. Extracting Flutter Project Data ===" . PHP_EOL;

// 1. AppConstants
$appConstantsFile = 'D:/my flutter projects/A.A.A/lib/core/utils/app_constants.dart';
$appConstants = file_exists($appConstantsFile) ? file_get_contents($appConstantsFile) : '';

// 2. Work Process
$workProcessFile = 'D:/my flutter projects/A.A.A/lib/features/home/presentation/widgets/my_work_process.dart';
$workProcess = file_exists($workProcessFile) ? file_get_contents($workProcessFile) : '';

// 3. About / Experience
$aboutExpFile = 'D:/my flutter projects/A.A.A/lib/features/home/presentation/widgets/about_experience_section.dart';
$aboutExp = file_exists($aboutExpFile) ? file_get_contents($aboutExpFile) : '';

// 4. Skills
$skillsFile = 'D:/my flutter projects/A.A.A/lib/features/home/presentation/widgets/skill_section.dart';
$skills = file_exists($skillsFile) ? file_get_contents($skillsFile) : '';

// 5. Hero / Headline / Profile
$heroFile = 'D:/my flutter projects/A.A.A/lib/features/home/presentation/widgets/hero_headline.dart';
$hero = file_exists($heroFile) ? file_get_contents($heroFile) : '';

// 6. Footer
$footerFile = 'D:/my flutter projects/A.A.A/lib/features/home/presentation/widgets/footer_section.dart';
$footer = file_exists($footerFile) ? file_get_contents($footerFile) : '';

echo "--- AppConstants.dart excerpt ---" . PHP_EOL;
echo substr($appConstants, 0, 1500) . PHP_EOL;

echo "--- Work Process excerpt ---" . PHP_EOL;
echo substr($workProcess, 0, 1500) . PHP_EOL;

echo "--- About Experience excerpt ---" . PHP_EOL;
echo substr($aboutExp, 0, 1500) . PHP_EOL;

echo "--- Skills excerpt ---" . PHP_EOL;
echo substr($skills, 0, 1500) . PHP_EOL;

echo "--- Footer excerpt ---" . PHP_EOL;
echo substr($footer, 0, 1500) . PHP_EOL;

