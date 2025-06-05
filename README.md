<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).



// Wizard::make([
            //     

            //     Step::make('Incomes')
            //         ->schema([
            //             // SALARY SECTION
            //             Section::make('Income from Salary')
            //                 ->schema([
            //                     Toggle::make('no_form_16')
            //                         ->label('No Form 16')
            //                         ->reactive(),

            //                     Grid::make(2)->schema([
            //                         FileUpload::make('form_16')
            //                             ->label('Form 16')
            //                             ->multiple()
            //                             ->visible(fn(Get $get) => $get('no_form_16') === false),

            //                         FileUpload::make('salary_slips')
            //                             ->label('Salary Slips')
            //                             ->multiple()
            //                             ->visible(fn(Get $get) => $get('no_form_16') === false),

            //                         FileUpload::make('arrears_sheet')
            //                             ->label('Arrears Sheet (if received)')
            //                             ->multiple()
            //                             ->visible(fn(Get $get) => $get('no_form_16') === false),

            //                         TextInput::make('employer_pan')
            //                             ->label('TAN or PAN of Employer')
            //                             ->visible(fn(Get $get) => $get('no_form_16') === true),
 
            //                         Textarea::make('employer_address')
            //                             ->label('Address of Employer')
            //                             ->visible(fn(Get $get) => $get('no_form_16') === true),

            //                         TextInput::make('salary_amount')
            //                             ->label('Salary Amount')
            //                             ->numeric()
            //                             ->visible(fn(Get $get) => $get('no_form_16') === true),
            //                     ])
            //                     ,

            //                     Section::make('HRA Details')
            //                         ->schema([
            //                             TextInput::make('hra_rent_paid')->label('Rent Paid'),
            //                             TextInput::make('hra_city')->label('City of Residence'),
            //                             TextInput::make('hra_landlord_name')->label('Name of Landlord'),
            //                             Textarea::make('hra_property_address')->label('Address of the Property'),
            //                         ])->columns(2),
            //                 ])
            //                 ->hidden(fn(Get $get) => !in_array('salary', (array)$get('data.income_types'))),

            //             // HOUSE PROPERTY SECTION
            //             Section::make('Income from House Property')
            //                 ->schema([
            //                     Repeater::make('rented_properties')
            //                         ->label('Rented Properties')
            //                         ->schema([
            //                             TextInput::make('tenant_name')->label('Tenant Name'),
            //                             TextInput::make('property_address')->label('Address of Property'),
            //                             TextInput::make('rental_income')->label('Rental Income'),
            //                             FileUpload::make('tax_receipts')->label('Receipts of House Tax / Property Tax')->multiple(),
            //                             FileUpload::make('interest_certificate')->label('Interest Certificate')->multiple(),
            //                             TextInput::make('ownership_percent')->label('Percentage of Ownership'),
            //                             TextInput::make('months_occupied')->label('No. of Months of Occupancy'),
            //                         ])
            //                         ->columns(2)
            //                         ->defaultItems(1)
            //                         ->createItemButtonLabel('Add More Property'),

            //                     Section::make('Self-Occupied Property')
            //                         ->schema([
            //                             TextInput::make('self_address')->label('Address of Property'),
            //                             FileUpload::make('self_interest_certificate')->label('Interest Certificate')->multiple(),
            //                             TextInput::make('self_ownership_percent')->label('Percentage of Ownership'),
            //                         ])->columns(2),
            //                 ])
            //                 ->hidden(fn(Get $get) => !in_array('house_property', (array)$get('data.income_types'))),

            //             //business section
            //             Section::make('Income from Business & Profession')
            //                 ->schema([
            //                     Repeater::make('businesses')
            //                         ->label('Business Ventures')
            //                         ->schema([
            //                             // Presumptive Scheme
            //                             Section::make('Presumptive Scheme')
            //                                 ->schema([
            //                                     TextInput::make('presumptive_business_name')
            //                                         ->label('Name of the Business'),
            //                                     TextInput::make('presumptive_bank_sales')
            //                                         ->label('Bank Sales')
            //                                         ->numeric(),
            //                                     TextInput::make('presumptive_cash_sales')
            //                                         ->label('Cash Sales')
            //                                         ->numeric(),
            //                                 ])
            //                                 ->columns(2),

            //                             // Normal Business
            //                             Section::make('Normal Business')
            //                                 ->schema([
            //                                     TextInput::make('normal_total_sales')
            //                                         ->label('Total Sales')
            //                                         ->numeric(),
            //                                     TextInput::make('normal_total_expenses')
            //                                         ->label('Total Expenses')
            //                                         ->numeric(),
            //                                     FileUpload::make('normal_bank_statement')
            //                                         ->label('Bank Statement for Financial Year')
            //                                         ->multiple(),
            //                                 ])
            //                                 ->columns(2),

            //                             // Partnership Firm Income
            //                             Section::make('Interest, Remuneration, Profit from Firm')
            //                                 ->schema([
            //                                     TextInput::make('firm_name')
            //                                         ->label('Firm Name'),
            //                                     TextInput::make('firm_pan')
            //                                         ->label('Firm Pan'),
            //                                     TextInput::make('firm_share_percent')
            //                                         ->label('Percentage of Share')
            //                                         ->numeric(),

            //                                     TextInput::make('firm_remuneration')
            //                                         ->label('Remuneration / Salary')
            //                                         ->numeric(),
            //                                     TextInput::make('firm_interest')
            //                                         ->label('Interest on Capital')
            //                                         ->numeric(),
            //                                     TextInput::make('firm_profit_loss')
            //                                         ->label('Profit / Loss of Firm')
            //                                         ->numeric(),
            //                                     TextInput::make('firm_closing_balance')
            //                                         ->label('Closing Balance of Capital (As on 31st March)')
            //                                         ->numeric(),
            //                                 ])
            //                                 ->columns(2),
            //                         ])
            //                         ->createItemButtonLabel('Add More Business')
            //                         ->defaultItems(1)
            //                         ->columns(1),
            //                 ])
            //                 ->hidden(fn(Get $get) => !in_array('business', (array)$get('data.income_types'))),
            //             Section::make('Income from Capital Gains')
            //                 ->schema([
            //                     Section::make('Sale of Securities')
            //                         ->description('Eg: Listed Securities, Zero coupon Bonds, Equity Oriented Funds, Unit of Business Trust')
            //                         ->schema([
            //                             FileUpload::make('demat_statement')
            //                                 ->label('Demat Statement for the Financial Year')
            //                                 ->multiple(),
            //                         ])
            //                         ->columns(1),

            //                     Section::make('Sale of Immovable Property')
            //                         ->schema([
            //                             FileUpload::make('sale_deed')->label('Sale Deed')->multiple(),
            //                             FileUpload::make('purchase_deed')->label('Purchase Deed')->multiple(),
            //                             Textarea::make('improvement_expenses_details')->label('Details of Expenses in Improvement of Asset, if any'),
            //                         ])
            //                         ->columns(2),
            //                 ])
            //                 ->hidden(fn(Get $get) => !in_array('capital_gains', (array)$get('data.income_types'))),

            //             // OTHER SOURCES SECTION
            //             Section::make('Income from Other Sources')
            //                 ->schema([
            //                     FileUpload::make('interest_certificate')->label('Interest Certificate (Savings/FD/RD)')->multiple(),

            //                     Textarea::make('dividend_income')->label('Dividend Income, if any'),

            //                     Textarea::make('interest_from_others')->label('Interest from other party, if any'),

            //                     FileUpload::make('crypto_income_statement')->label('Annual Statement from Crypto / Virtual Digital Assets')->multiple(),

            //                     Textarea::make('other_income_details')->label('Other income not covered under above heads'),
            //                 ])
            //                 ->hidden(fn(Get $get) => !in_array('other_sources', (array)$get('data.income_types'))),
            //         ]),
            //     Step::make('Deductions')
            //         ->schema([
            //             // 80C - Investments
            //             Section::make('80C - Investments')
            //                 ->schema([
            //                     FileUpload::make('deduction_80c_life_insurance')
            //                         ->label('Premium payment receipts for life insurance')
            //                         ->multiple(),
            //                     FileUpload::make('deduction_80c_ppf')
            //                         ->label('PPF account statements')
            //                         ->multiple(),
            //                     FileUpload::make('deduction_80c_epf')
            //                         ->label('EPF account statement')
            //                         ->multiple(),
            //                     FileUpload::make('deduction_80c_mutual_funds')
            //                         ->label('Tax Saver Mutual Funds/ FDs')
            //                         ->multiple(),
            //                     FileUpload::make('deduction_80c_tuition_fees')
            //                         ->label('Amount of Tuition fees of Spouse/Children')
            //                         ->multiple(),
            //                     FileUpload::make('deduction_80c_other')
            //                         ->label('Any other Investment Proofs like SCSS, Sukanya scheme etc.')
            //                         ->multiple(),
            //                 ])
            //                 ->columns(2)
            //                 ->hidden(fn(Get $get) => !in_array('80C', (array)$get('data.deduction_types'))),

            //             // 80D - Mediclaim
            //             Section::make('80D - Mediclaim')
            //                 ->schema([
            //                     FileUpload::make('deduction_80d_health_insurance')
            //                         ->label('Premium payment receipts for health insurance for self, spouse, children and parents')
            //                         ->multiple(),
            //                 ])
            //                 ->columns(2)
            //                 ->hidden(fn(Get $get) => !in_array('80D', (array)$get('data.deduction_types'))),

            //             // 80E - Education Loan Interest
            //             Section::make('80E - Interest on Education Loan')
            //                 ->schema([
            //                     FileUpload::make('deduction_80e_interest_certificate')
            //                         ->label('Bank statement showing interest payments OR Interest Certificate')
            //                         ->multiple(),
            //                 ])
            //                 ->columns(2)
            //                 ->hidden(fn(Get $get) => !in_array('80E', (array)$get('data.deduction_types'))),

            //             // 80G / 80GGA / 80GGC - Donations
            //             Section::make('80G / 80GGA / 80GGC - Donations')
            //                 ->schema([
            //                     FileUpload::make('deduction_80g_donation_receipt')
            //                         ->label('Receipt of Donation (Charitable Institution / Political Parties / Scientific Research etc.)')
            //                         ->multiple(),
            //                 ])
            //                 ->columns(2)
            //                 ->hidden(fn(Get $get) => !in_array('80G', (array)$get('data.deduction_types'))),

            //             // Other Deduction Document
            //             Section::make('Other Deduction Documents')
            //                 ->schema([
            //                     FileUpload::make('deduction_other_documents')
            //                         ->label('Documents like EV Vehicle Loan / Disability Document / NPS etc.')
            //                         ->multiple(),
            //                 ])
            //                 ->columns(2)
            //                 ->hidden(fn(Get $get) => !in_array('other', (array)$get('data.deduction_types'))),
            //         ])

            // ])->columnSpanFull(),
