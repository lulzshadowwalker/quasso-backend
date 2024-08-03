<?php

namespace App\Console\Commands;

use App\Models\Language;
use Illuminate\Console\Command;

class UpsertLanguage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'upsert:language';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upsert languages into the database.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $languages = [
            [
                "name" => "Afrikaans",
                "code" => "AF",
            ],
            [
                "name" => "Albanian",
                "code" => "SQ",
            ],
            [
                "name" => "Arabic",
                "code" => "AR",
            ],
            [
                "name" => "Armenian",
                "code" => "HY",
            ],
            [
                "name" => "Basque",
                "code" => "EU",
            ],
            [
                "name" => "Bengali",
                "code" => "BN",
            ],
            [
                "name" => "Bulgarian",
                "code" => "BG",
            ],
            [
                "name" => "Catalan",
                "code" => "CA",
            ],
            [
                "name" => "Cambodian",
                "code" => "KM",
            ],
            [
                "name" => "Chinese (Mandarin)",
                "code" => "ZH",
            ],
            [
                "name" => "Croatian",
                "code" => "HR",
            ],
            [
                "name" => "Czech",
                "code" => "CS",
            ],
            [
                "name" => "Danish",
                "code" => "DA",
            ],
            [
                "name" => "Dutch",
                "code" => "NL",
            ],
            [
                "name" => "English",
                "code" => "EN",
            ],
            [
                "name" => "Estonian",
                "code" => "ET",
            ],
            [
                "name" => "Fiji",
                "code" => "FJ",
            ],
            [
                "name" => "Finnish",
                "code" => "FI",
            ],
            [
                "name" => "French",
                "code" => "FR",
            ],
            [
                "name" => "Georgian",
                "code" => "KA",
            ],
            [
                "name" => "German",
                "code" => "DE",
            ],
            [
                "name" => "Greek",
                "code" => "EL",
            ],
            [
                "name" => "Gujarati",
                "code" => "GU",
            ],
            [
                "name" => "Hebrew",
                "code" => "HE",
            ],
            [
                "name" => "Hindi",
                "code" => "HI",
            ],
            [
                "name" => "Hungarian",
                "code" => "HU",
            ],
            [
                "name" => "Icelandic",
                "code" => "IS",
            ],
            [
                "name" => "Indonesian",
                "code" => "ID",
            ],
            [
                "name" => "Irish",
                "code" => "GA",
            ],
            [
                "name" => "Italian",
                "code" => "IT",
            ],
            [
                "name" => "Japanese",
                "code" => "JA",
            ],
            [
                "name" => "Javanese",
                "code" => "JW",
            ],
            [
                "name" => "Korean",
                "code" => "KO",
            ],
            [
                "name" => "Latin",
                "code" => "LA",
            ],
            [
                "name" => "Latvian",
                "code" => "LV",
            ],
            [
                "name" => "Lithuanian",
                "code" => "LT",
            ],
            [
                "name" => "Macedonian",
                "code" => "MK",
            ],
            [
                "name" => "Malay",
                "code" => "MS",
            ],
            [
                "name" => "Malayalam",
                "code" => "ML",
            ],
            [
                "name" => "Maltese",
                "code" => "MT",
            ],
            [
                "name" => "Maori",
                "code" => "MI",
            ],
            [
                "name" => "Marathi",
                "code" => "MR",
            ],
            [
                "name" => "Mongolian",
                "code" => "MN",
            ],
            [
                "name" => "Nepali",
                "code" => "NE",
            ],
            [
                "name" => "Norwegian",
                "code" => "NO",
            ],
            [
                "name" => "Persian",
                "code" => "FA",
            ],
            [
                "name" => "Polish",
                "code" => "PL",
            ],
            [
                "name" => "Portuguese",
                "code" => "PT",
            ],
            [
                "name" => "Punjabi",
                "code" => "PA",
            ],
            [
                "name" => "Quechua",
                "code" => "QU",
            ],
            [
                "name" => "Romanian",
                "code" => "RO",
            ],
            [
                "name" => "Russian",
                "code" => "RU",
            ],
            [
                "name" => "Samoan",
                "code" => "SM",
            ],
            [
                "name" => "Serbian",
                "code" => "SR",
            ],
            [
                "name" => "Slovak",
                "code" => "SK",
            ],
            [
                "name" => "Slovenian",
                "code" => "SL",
            ],
            [
                "name" => "Spanish",
                "code" => "ES",
            ],
            [
                "name" => "Swahili",
                "code" => "SW",
            ],
            [
                "name" => "Swedish",
                "code" => "SV",
            ],
            [
                "name" => "Tamil",
                "code" => "TA",
            ],
            [
                "name" => "Tatar",
                "code" => "TT",
            ],
            [
                "name" => "Telugu",
                "code" => "TE",
            ],
            [
                "name" => "Thai",
                "code" => "TH",
            ],
            [
                "name" => "Tibetan",
                "code" => "BO",
            ],
            [
                "name" => "Tonga",
                "code" => "TO",
            ],
            [
                "name" => "Turkish",
                "code" => "TR",
            ],
            [
                "name" => "Ukrainian",
                "code" => "UK",
            ],
            [
                "name" => "Urdu",
                "code" => "UR",
            ],
            [
                "name" => "Uzbek",
                "code" => "UZ",
            ],
            [
                "name" => "Vietnamese",
                "code" => "VI",
            ],
            [
                "name" => "Welsh",
                "code" => "CY",
            ],
            [
                "name" => "Xhosa",
                "code" => "XH",
            ],
        ];

        foreach ($languages as $language) {
            Language::updateOrCreate(
                ['code' => $language['code']],
                ['name' => $language['name']],
            );
        }

        $this->info('Languages upserted successfully.');
    }
}
