<?php

namespace App\Console\Commands;

use App\Models\Currency;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpsertCurrency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'upsert:currency';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upserts currencies';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currencies = [
            ['name' => 'Afghan Afghani', 'code' => 'AFN', 'symbol' => '؋'],
            ['name' => 'Albanian Lek', 'code' => 'ALL', 'symbol' => 'L'],
            ['name' => 'Algerian Dinar', 'code' => 'DZD', 'symbol' => 'دج'],
            ['name' => 'Angolan Kwanza', 'code' => 'AOA', 'symbol' => 'Kz'],
            ['name' => 'Argentine Peso', 'code' => 'ARS', 'symbol' => '$'],
            ['name' => 'Armenian Dram', 'code' => 'AMD', 'symbol' => '֏'],
            ['name' => 'Aruban Florin', 'code' => 'AWG', 'symbol' => 'ƒ'],
            ['name' => 'Australian Dollar', 'code' => 'AUD', 'symbol' => '$'],
            ['name' => 'Azerbaijani Manat', 'code' => 'AZN', 'symbol' => '₼'],
            ['name' => 'Bahamian Dollar', 'code' => 'BSD', 'symbol' => '$'],
            ['name' => 'Bahraini Dinar', 'code' => 'BHD', 'symbol' => '.د.ب'],
            ['name' => 'Bangladeshi Taka', 'code' => 'BDT', 'symbol' => '৳'],
            ['name' => 'Barbadian Dollar', 'code' => 'BBD', 'symbol' => '$'],
            ['name' => 'Belarusian Ruble', 'code' => 'BYN', 'symbol' => 'Br'],
            ['name' => 'Belize Dollar', 'code' => 'BZD', 'symbol' => '$'],
            ['name' => 'Bermudian Dollar', 'code' => 'BMD', 'symbol' => '$'],
            ['name' => 'Bhutanese Ngultrum', 'code' => 'BTN', 'symbol' => 'Nu.'],
            ['name' => 'Bolivian Boliviano', 'code' => 'BOB', 'symbol' => 'Bs.'],
            ['name' => 'Bosnia-Herzegovina Convertible Mark', 'code' => 'BAM', 'symbol' => 'KM'],
            ['name' => 'Botswana Pula', 'code' => 'BWP', 'symbol' => 'P'],
            ['name' => 'Brazilian Real', 'code' => 'BRL', 'symbol' => 'R$'],
            ['name' => 'British Pound Sterling', 'code' => 'GBP', 'symbol' => '£'],
            ['name' => 'Brunei Dollar', 'code' => 'BND', 'symbol' => '$'],
            ['name' => 'Bulgarian Lev', 'code' => 'BGN', 'symbol' => 'лв'],
            ['name' => 'Burundian Franc', 'code' => 'BIF', 'symbol' => 'FBu'],
            ['name' => 'Cabo Verdean Escudo', 'code' => 'CVE', 'symbol' => '$'],
            ['name' => 'Cambodian Riel', 'code' => 'KHR', 'symbol' => '៛'],
            ['name' => 'Canadian Dollar', 'code' => 'CAD', 'symbol' => '$'],
            ['name' => 'Cayman Islands Dollar', 'code' => 'KYD', 'symbol' => '$'],
            ['name' => 'Central African CFA Franc', 'code' => 'XAF', 'symbol' => 'FCFA'],
            ['name' => 'CFP Franc', 'code' => 'XPF', 'symbol' => '₣'],
            ['name' => 'Chilean Peso', 'code' => 'CLP', 'symbol' => '$'],
            ['name' => 'Chinese Yuan', 'code' => 'CNY', 'symbol' => '¥'],
            ['name' => 'Colombian Peso', 'code' => 'COP', 'symbol' => '$'],
            ['name' => 'Comorian Franc', 'code' => 'KMF', 'symbol' => 'CF'],
            ['name' => 'Congolese Franc', 'code' => 'CDF', 'symbol' => 'FC'],
            ['name' => 'Costa Rican Colón', 'code' => 'CRC', 'symbol' => '₡'],
            ['name' => 'Croatian Kuna', 'code' => 'HRK', 'symbol' => 'kn'],
            ['name' => 'Cuban Peso', 'code' => 'CUP', 'symbol' => '$'],
            ['name' => 'Czech Koruna', 'code' => 'CZK', 'symbol' => 'Kč'],
            ['name' => 'Danish Krone', 'code' => 'DKK', 'symbol' => 'kr'],
            ['name' => 'Djiboutian Franc', 'code' => 'DJF', 'symbol' => 'Fdj'],
            ['name' => 'Dominican Peso', 'code' => 'DOP', 'symbol' => 'RD$'],
            ['name' => 'East Caribbean Dollar', 'code' => 'XCD', 'symbol' => '$'],
            ['name' => 'Egyptian Pound', 'code' => 'EGP', 'symbol' => '£'],
            ['name' => 'Eritrean Nakfa', 'code' => 'ERN', 'symbol' => 'Nfk'],
            ['name' => 'Estonian Kroon', 'code' => 'EEK', 'symbol' => 'kr'],
            ['name' => 'Ethiopian Birr', 'code' => 'ETB', 'symbol' => 'Br'],
            ['name' => 'Euro', 'code' => 'EUR', 'symbol' => '€'],
            ['name' => 'Falkland Islands Pound', 'code' => 'FKP', 'symbol' => '£'],
            ['name' => 'Fijian Dollar', 'code' => 'FJD', 'symbol' => '$'],
            ['name' => 'Gambian Dalasi', 'code' => 'GMD', 'symbol' => 'D'],
            ['name' => 'Georgian Lari', 'code' => 'GEL', 'symbol' => '₾'],
            ['name' => 'Ghanaian Cedi', 'code' => 'GHS', 'symbol' => '₵'],
            ['name' => 'Gibraltar Pound', 'code' => 'GIP', 'symbol' => '£'],
            ['name' => 'Guatemalan Quetzal', 'code' => 'GTQ', 'symbol' => 'Q'],
            ['name' => 'Guinean Franc', 'code' => 'GNF', 'symbol' => 'FG'],
            ['name' => 'Guyanese Dollar', 'code' => 'GYD', 'symbol' => '$'],
            ['name' => 'Haitian Gourde', 'code' => 'HTG', 'symbol' => 'G'],
            ['name' => 'Honduran Lempira', 'code' => 'HNL', 'symbol' => 'L'],
            ['name' => 'Hong Kong Dollar', 'code' => 'HKD', 'symbol' => '$'],
            ['name' => 'Hungarian Forint', 'code' => 'HUF', 'symbol' => 'Ft'],
            ['name' => 'Icelandic Króna', 'code' => 'ISK', 'symbol' => 'kr'],
            ['name' => 'Indian Rupee', 'code' => 'INR', 'symbol' => '₹'],
            ['name' => 'Indonesian Rupiah', 'code' => 'IDR', 'symbol' => 'Rp'],
            ['name' => 'Iranian Rial', 'code' => 'IRR', 'symbol' => '﷼'],
            ['name' => 'Iraqi Dinar', 'code' => 'IQD', 'symbol' => 'ع.د'],
            ['name' => 'Israeli New Shekel', 'code' => 'ILS', 'symbol' => '₪'],
            ['name' => 'Jamaican Dollar', 'code' => 'JMD', 'symbol' => '$'],
            ['name' => 'Japanese Yen', 'code' => 'JPY', 'symbol' => '¥'],
            ['name' => 'Jordanian Dinar', 'code' => 'JOD', 'symbol' => 'د.ا'],
            ['name' => 'Kazakhstani Tenge', 'code' => 'KZT', 'symbol' => '₸'],
            ['name' => 'Kenyan Shilling', 'code' => 'KES', 'symbol' => 'KSh'],
            ['name' => 'Kuwaiti Dinar', 'code' => 'KWD', 'symbol' => 'د.ك'],
            ['name' => 'Kyrgyzstani Som', 'code' => 'KGS', 'symbol' => 'лв'],
            ['name' => 'Lao Kip', 'code' => 'LAK', 'symbol' => '₭'],
            ['name' => 'Lebanese Pound', 'code' => 'LBP', 'symbol' => '£'],
            ['name' => 'Lesotho Loti', 'code' => 'LSL', 'symbol' => 'L'],
            ['name' => 'Liberian Dollar', 'code' => 'LRD', 'symbol' => '$'],
            ['name' => 'Libyan Dinar', 'code' => 'LYD', 'symbol' => 'ل.د'],
            ['name' => 'Lithuanian Litas', 'code' => 'LTL', 'symbol' => 'Lt'],
            ['name' => 'Macanese Pataca', 'code' => 'MOP', 'symbol' => 'MOP$'],
            ['name' => 'Macedonian Denar', 'code' => 'MKD', 'symbol' => 'ден'],
            ['name' => 'Malagasy Ariary', 'code' => 'MGA', 'symbol' => 'Ar'],
            ['name' => 'Malawian Kwacha', 'code' => 'MWK', 'symbol' => 'MK'],
            ['name' => 'Malaysian Ringgit', 'code' => 'MYR', 'symbol' => 'RM'],
            ['name' => 'Maldivian Rufiyaa', 'code' => 'MVR', 'symbol' => 'Rf'],
            ['name' => 'Mauritanian Ouguiya', 'code' => 'MRU', 'symbol' => 'UM'],
            ['name' => 'Mauritian Rupee', 'code' => 'MUR', 'symbol' => '₨'],
            ['name' => 'Mexican Peso', 'code' => 'MXN', 'symbol' => '$'],
            ['name' => 'Moldovan Leu', 'code' => 'MDL', 'symbol' => 'L'],
            ['name' => 'Mongolian Tögrög', 'code' => 'MNT', 'symbol' => '₮'],
            ['name' => 'Moroccan Dirham', 'code' => 'MAD', 'symbol' => 'د.م.'],
            ['name' => 'Mozambican Metical', 'code' => 'MZN', 'symbol' => 'MT'],
            ['name' => 'Myanmar Kyat', 'code' => 'MMK', 'symbol' => 'K'],
            ['name' => 'Namibian Dollar', 'code' => 'NAD', 'symbol' => '$'],
            ['name' => 'Nepalese Rupee', 'code' => 'NPR', 'symbol' => '₨'],
            ['name' => 'Netherlands Antillean Guilder', 'code' => 'ANG', 'symbol' => 'ƒ'],
            ['name' => 'New Taiwan Dollar', 'code' => 'TWD', 'symbol' => '$'],
            ['name' => 'New Zealand Dollar', 'code' => 'NZD', 'symbol' => '$'],
            ['name' => 'Nicaraguan Córdoba', 'code' => 'NIO', 'symbol' => 'C$'],
            ['name' => 'Nigerian Naira', 'code' => 'NGN', 'symbol' => '₦'],
            ['name' => 'North Korean Won', 'code' => 'KPW', 'symbol' => '₩'],
            ['name' => 'Norwegian Krone', 'code' => 'NOK', 'symbol' => 'kr'],
            ['name' => 'Omani Rial', 'code' => 'OMR', 'symbol' => 'ر.ع.'],
            ['name' => 'Pakistani Rupee', 'code' => 'PKR', 'symbol' => '₨'],
            ['name' => 'Panamanian Balboa', 'code' => 'PAB', 'symbol' => 'B/.'],
            ['name' => 'Papua New Guinean Kina', 'code' => 'PGK', 'symbol' => 'K'],
            ['name' => 'Paraguayan Guaraní', 'code' => 'PYG', 'symbol' => '₲'],
            ['name' => 'Peruvian Sol', 'code' => 'PEN', 'symbol' => 'S/'],
            ['name' => 'Philippine Peso', 'code' => 'PHP', 'symbol' => '₱'],
            ['name' => 'Polish Złoty', 'code' => 'PLN', 'symbol' => 'zł'],
            ['name' => 'Qatari Riyal', 'code' => 'QAR', 'symbol' => 'ر.ق'],
            ['name' => 'Romanian Leu', 'code' => 'RON', 'symbol' => 'lei'],
            ['name' => 'Russian Ruble', 'code' => 'RUB', 'symbol' => '₽'],
            ['name' => 'Rwandan Franc', 'code' => 'RWF', 'symbol' => 'FRw'],
            ['name' => 'Saint Helena Pound', 'code' => 'SHP', 'symbol' => '£'],
            ['name' => 'Samoan Tala', 'code' => 'WST', 'symbol' => 'T'],
            ['name' => 'São Tomé and Príncipe Dobra', 'code' => 'STN', 'symbol' => 'Db'],
            ['name' => 'Saudi Riyal', 'code' => 'SAR', 'symbol' => 'ر.س'],
            ['name' => 'Serbian Dinar', 'code' => 'RSD', 'symbol' => 'дин.'],
            ['name' => 'Seychellois Rupee', 'code' => 'SCR', 'symbol' => '₨'],
            ['name' => 'Sierra Leonean Leone', 'code' => 'SLL', 'symbol' => 'Le'],
            ['name' => 'Singapore Dollar', 'code' => 'SGD', 'symbol' => '$'],
            ['name' => 'Solomon Islands Dollar', 'code' => 'SBD', 'symbol' => '$'],
            ['name' => 'Somali Shilling', 'code' => 'SOS', 'symbol' => 'Sh'],
            ['name' => 'South African Rand', 'code' => 'ZAR', 'symbol' => 'R'],
            ['name' => 'South Korean Won', 'code' => 'KRW', 'symbol' => '₩'],
            ['name' => 'South Sudanese Pound', 'code' => 'SSP', 'symbol' => '£'],
            ['name' => 'Sri Lankan Rupee', 'code' => 'LKR', 'symbol' => 'Rs'],
            ['name' => 'Sudanese Pound', 'code' => 'SDG', 'symbol' => 'ج.س.'],
            ['name' => 'Surinamese Dollar', 'code' => 'SRD', 'symbol' => '$'],
            ['name' => 'Swazi Lilangeni', 'code' => 'SZL', 'symbol' => 'E'],
            ['name' => 'Swedish Krona', 'code' => 'SEK', 'symbol' => 'kr'],
            ['name' => 'Swiss Franc', 'code' => 'CHF', 'symbol' => 'Fr'],
            ['name' => 'Syrian Pound', 'code' => 'SYP', 'symbol' => '£'],
            ['name' => 'Tajikistani Somoni', 'code' => 'TJS', 'symbol' => 'ЅМ'],
            ['name' => 'Tanzanian Shilling', 'code' => 'TZS', 'symbol' => 'Sh'],
            ['name' => 'Thai Baht', 'code' => 'THB', 'symbol' => '฿'],
            ['name' => 'Tongan Paʻanga', 'code' => 'TOP', 'symbol' => 'T$'],
            ['name' => 'Trinidad and Tobago Dollar', 'code' => 'TTD', 'symbol' => '$'],
            ['name' => 'Tunisian Dinar', 'code' => 'TND', 'symbol' => 'د.ت'],
            ['name' => 'Turkish Lira', 'code' => 'TRY', 'symbol' => '₺'],
            ['name' => 'Turkmenistani Manat', 'code' => 'TMT', 'symbol' => 'm'],
            ['name' => 'Ugandan Shilling', 'code' => 'UGX', 'symbol' => 'USh'],
            ['name' => 'Ukrainian Hryvnia', 'code' => 'UAH', 'symbol' => '₴'],
            ['name' => 'United Arab Emirates Dirham', 'code' => 'AED', 'symbol' => 'د.إ'],
            ['name' => 'United States Dollar', 'code' => 'USD', 'symbol' => '$'],
            ['name' => 'Uruguayan Peso', 'code' => 'UYU', 'symbol' => '$'],
            ['name' => 'Uzbekistani Som', 'code' => 'UZS', 'symbol' => 'лв'],
            ['name' => 'Vanuatu Vatu', 'code' => 'VUV', 'symbol' => 'VT'],
            ['name' => 'Venezuelan Bolívar', 'code' => 'VES', 'symbol' => 'Bs.S'],
            ['name' => 'Vietnamese đồng', 'code' => 'VND', 'symbol' => '₫'],
            ['name' => 'West African CFA franc', 'code' => 'XOF', 'symbol' => 'Fr'],
            ['name' => 'Yemeni Rial', 'code' => 'YER', 'symbol' => '﷼'],
            ['name' => 'Zambian Kwacha', 'code' => 'ZMW', 'symbol' => 'ZK'],
            ['name' => 'Zimbabwean Dollar', 'code' => 'ZWL', 'symbol' => '$'],
        ];

        foreach ($currencies as $currency) {
            Currency::updateOrCreate(
                ['code' => $currency['code']],
                ['name' => $currency['name'], 'symbol' => $currency['symbol']]
            );
        }

        $this->info('Currencies upserted successfully.');
    }
}
