<?php

// Read full files
$appConstants = file_get_contents('D:/my flutter projects/A.A.A/lib/core/utils/app_constants.dart');
$aboutExp = file_get_contents('D:/my flutter projects/A.A.A/lib/features/home/presentation/widgets/about_experience_section.dart');
$skills = file_get_contents('D:/my flutter projects/A.A.A/lib/features/home/presentation/widgets/skill_section.dart');
$hero = file_get_contents('D:/my flutter projects/A.A.A/lib/features/home/presentation/widgets/hero_headline.dart');
$footer = file_get_contents('D:/my flutter projects/A.A.A/lib/features/home/presentation/widgets/footer_section.dart');
$dbSql = file_get_contents('D:/php/portfolio/database.sql');

echo "=========================================================" . PHP_EOL;
echo "  1. ABOUT & EXPERIENCE IN FLUTTER" . PHP_EOL;
echo "=========================================================" . PHP_EOL;
echo $aboutExp . PHP_EOL;

echo "=========================================================" . PHP_EOL;
echo "  2. HERO & HEADLINE IN FLUTTER" . PHP_EOL;
echo "=========================================================" . PHP_EOL;
echo $hero . PHP_EOL;

echo "=========================================================" . PHP_EOL;
echo "  3. SKILLS IN FLUTTER" . PHP_EOL;
echo "=========================================================" . PHP_EOL;
echo $skills . PHP_EOL;

echo "=========================================================" . PHP_EOL;
echo "  4. FOOTER & CONTACT IN FLUTTER" . PHP_EOL;
echo "=========================================================" . PHP_EOL;
echo $footer . PHP_EOL;

