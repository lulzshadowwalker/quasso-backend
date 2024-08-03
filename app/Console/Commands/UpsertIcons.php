<?php

namespace App\Console\Commands;

use App\Models\Icon;
use Illuminate\Console\Command;

class UpsertIcons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'upsert:icons';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upsert icons into the icons table.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $icons = [
            [
                "name" => "Magnifying Glass",
                "code" => "fa-solid fa-magnifying-glass",
                "source" => "FONT_AWESOME"
            ],
            [
                "name" => "User",
                "code" => "fa-solid fa-user",
                "source" => "FONT_AWESOME"
            ],
            [
                "name" => "Bell",
                "code" => "fa-solid fa-bell",
                "source" => "FONT_AWESOME"
            ],
            [
                "name" => "Cog",
                "code" => "fa-solid fa-cog",
                "source" => "FONT_AWESOME"
            ],
            [
                "name" => "Heart",
                "code" => "fa-solid fa-heart",
                "source" => "FONT_AWESOME"
            ],
        ];

        foreach ($icons as $icon) {
            Icon::updateOrCreate(
                ["code" => $icon["code"]],
                $icon
            );
        }

        $this->info("Icons upserted successfully.");
    }
}
