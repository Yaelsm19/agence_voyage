<?php
function buildSmartCaptcha(): array {
    $length = random_int(5, 8);
    $chars = '';
    
    for ($i = 0; $i < $length; $i++) {
        $chars .= chr(random_int(0, 1) ? random_int(65, 90) : random_int(97, 122));
    }
    
    $modes = ['vowel', 'consonant', 'uppercase', 'lowercase'];
    $mode = $modes[array_rand($modes)];
    
    $vowels = ['a', 'e', 'i', 'o', 'u', 'y'];
    
    $vowelCount = 0;
    $upperCount = 0;
    $lowerCount = 0;
    
    foreach (str_split($chars) as $ch) {
        if (ctype_upper($ch)) {
            $upperCount++;
        } else {
            $lowerCount++;
        }
        
        if (in_array(strtolower($ch), $vowels, true)) {
            $vowelCount++;
        }
    }
    
    $consonantCount = $length - $vowelCount;
    
    switch ($mode) {
        case 'vowel':
            return ["Dans la chaîne « $chars », combien y a‑t‑il de voyelles ?", $vowelCount];
        case 'consonant':
            return ["Dans la chaîne « $chars », combien y a‑t‑il de consonnes ?", $consonantCount];
        case 'uppercase':
            return ["Dans la chaîne « $chars », combien y a‑t‑il de lettres majuscules ?", $upperCount];
        default:
            return ["Dans la chaîne « $chars », combien y a‑t‑il de lettres minuscules ?", $lowerCount];
    }
}