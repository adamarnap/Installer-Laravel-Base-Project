# Location Selector Component Documentation

Component Blade untuk memilih lokasi (Provinsi, Kabupaten/Kota, Kecamatan, Desa/Kelurahan) secara cascading dengan Select2 dan Tailwind CSS.

## Features

- 🎯 **Cascading Dropdown** - Provinsi → Kabupaten → Kecamatan → Desa
- 🔄 **AJAX Loading** - Data dimuat dinamis menggunakan fetch API
- ✨ **Select2 Integration** - Dropdown yang modern dengan search functionality
- 🎨 **Tailwind CSS** - Styling yang konsisten dengan template Trezo
- 🌙 **Dark Mode Support** - Otomatis mengikuti theme aplikasi
- 📝 **Form Validation Ready** - Support Laravel validation dan error display
- 🔒 **Smart Disable** - Dropdown otomatis disable/enable berdasarkan parent selection
- 💾 **Edit Mode Support** - Pre-populate data untuk form edit

## Table of Contents

- [Installation](#installation)
- [Basic Usage](#basic-usage)
- [Available Props](#available-props)
- [Form Field Names](#form-field-names)
- [Examples](#examples)
- [Backend Integration](#backend-integration)
- [Files Structure](#files-structure)
- [Troubleshooting](#troubleshooting)

## Installation

Component ini sudah tersedia di project. Pastikan dependencies sudah terinstall:

```bash
composer install
npm install
```

## Basic Usage

### Create Mode (Form Baru)

```blade
<x-location-selector :required="true" />
```

### Edit Mode (Dengan Data Tersimpan)

```blade
<x-location-selector 
    :selected-province="$ekop->provinsi_code"
    :selected-city="$ekop->kabupaten_code"
    :selected-district="$ekop->kecamatan_code"
    :selected-village="$ekop->kalurahan_code"
    :required="true"
/>
```

## Available Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `selected-province` | string\|null | `null` | Kode provinsi yang sudah dipilih (untuk mode edit) |
| `selected-city` | string\|null | `null` | Kode kabupaten/kota yang sudah dipilih |
| `selected-district` | string\|null | `null` | Kode kecamatan yang sudah dipilih |
| `selected-village` | string\|null | `null` | Kode desa/kelurahan yang sudah dipilih |
| `required` | boolean | `false` | Menampilkan indicator required (*) pada label |
| `show-labels` | boolean | `true` | Menampilkan atau menyembunyikan label |
| `container-class` | string | `'row'` | Custom CSS class untuk container wrapper |

### Prop Details

#### selected-province, selected-city, selected-district, selected-village
Digunakan untuk pre-populate data saat form edit. Gunakan **kode wilayah** (`code`) bukan ID.

**Contoh:**
```blade
{{-- ✅ Benar - menggunakan code --}}
:selected-province="$data->province_code"

{{-- ❌ Salah - menggunakan id --}}
:selected-province="$data->province_id"
```

#### required
Menentukan apakah field wajib diisi. Akan menampilkan tanda asterisk merah (*) pada label.

```blade
{{-- Field wajib diisi --}}
<x-location-selector :required="true" />

{{-- Field opsional --}}
<x-location-selector :required="false" />
```

#### show-labels
Mengontrol visibility label. Berguna jika ingin custom layout.

```blade
{{-- Tanpa label --}}
<x-location-selector :show-labels="false" />
```

#### container-class
Menambahkan custom CSS class pada wrapper component.

```blade
<x-location-selector container-class="my-custom-class" />
```

## Form Field Names

Component ini akan menghasilkan input fields dengan nama:

- `province_id` → berisi **code** provinsi
- `city_id` → berisi **code** kabupaten/kota
- `district_id` → berisi **code** kecamatan
- `village_id` → berisi **code** desa/kelurahan

> ⚠️ **Important:** Meskipun nama field menggunakan suffix `_id`, nilai yang dikirim adalah **kode wilayah** (`code`) bukan ID. Ini sesuai dengan relasi database package Laravolt Indonesia yang menggunakan `code` untuk foreign key.

## Examples

### Form Create

```blade
@extends('layouts.admin.master')

@section('content')
<form action="{{ route('locations.store') }}" method="POST">
    @csrf
    
    <x-location-selector :required="true" />
    
    <button type="submit">Submit</button>
</form>
@endsection
```

### Form Edit

```blade
@extends('layouts.admin.master')

@section('content')
<form action="{{ route('locations.update', $location) }}" method="POST">
    @csrf
    @method('PUT')
    
    <x-location-selector 
        :selected-province="$location->province_code"
        :selected-city="$location->city_code"
        :selected-district="$location->district_code"
        :selected-village="$location->village_code"
        :required="true"
    />
    
    <button type="submit">Update</button>
</form>
@endsection
```

### Tanpa Label

```blade
<x-location-selector 
    :required="false"
    :show-labels="false"
/>
```

### Dengan Custom Container Class

```blade
<x-location-selector 
    container-class="location-wrapper p-4 border rounded"
    :required="true"
/>
```

### Hanya Provinsi dan Kota

```blade
<x-location-selector 
    :selected-province="$data->province_code"
    :selected-city="$data->city_code"
/>
```

## Backend Integration

### Routes

Pastikan routes untuk location API sudah terdaftar di `routes/web.php`:

```php
Route::get('/api/locations/cities', [LocationController::class, 'getCities'])->name('locations.cities');
Route::get('/api/locations/districts', [LocationController::class, 'getDistricts'])->name('locations.districts');
Route::get('/api/locations/villages', [LocationController::class, 'getVillages'])->name('locations.villages');
```

### Controller

LocationController akan menerima parameter dengan nama:
- `province_code` untuk cities endpoint
- `city_code` untuk districts endpoint
- `district_code` untuk villages endpoint

```php
// app/Http/Controllers/LocationController.php
public function getCities(Request $request)
{
    $cities = $this->locationService->getCitiesByProvince($request->province_code);
    
    return response()->json([
        'success' => true,
        'data' => $cities
    ]);
}
```

### Validation

```php
$validated = $request->validate([
    'province_id' => 'required|exists:indonesia_provinces,code',
    'city_id' => 'required|exists:indonesia_cities,code',
    'district_id' => 'required|exists:indonesia_districts,code',
    'village_id' => 'required|exists:indonesia_villages,code',
]);
```

### Saving to Database

```php
// Mapping field name ke column name
$model->update([
    'province_code' => $request->province_id,
    'city_code' => $request->city_id,
    'district_code' => $request->district_id,
    'village_code' => $request->village_id,
]);
```

### Retrieving Data

Untuk menampilkan nama lokasi (bukan hanya code):

```php
// Eager loading relationships
$location = Location::with([
    'province',
    'city',
    'district',
    'village'
])->find($id);

// Di view
{{ $location->province->name ?? '-' }}
{{ $location->city->name ?? '-' }}
{{ $location->district->name ?? '-' }}
{{ $location->village->name ?? '-' }}
```

## Files Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   └── LocationController.php      # Handle AJAX requests
│   └── Services/
│       └── LocationService.php         # Business logic untuk location
└── View/
    └── Components/
        └── LocationSelector.php        # Component class

resources/
└── views/
    └── components/
        └── location-selector.blade.php # Component template

routes/
└── web.php                             # Location API routes
```

### Component Class (LocationSelector.php)

```php
<?php

namespace App\View\Components;

use App\Http\Services\LocationService;
use Illuminate\View\Component;

class LocationSelector extends Component
{
    public function __construct(
        LocationService $locationService,
        $selectedProvince = null,
        $selectedCity = null,
        $selectedDistrict = null,
        $selectedVillage = null,
        bool $required = false,
        bool $showLabels = true,
        string $containerClass = 'row'
    ) {
        // Component logic
    }
}
```

### Service Class (LocationService.php)

```php
<?php

namespace App\Http\Services;

use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;

class LocationService
{
    public function getProvinces() { }
    public function getCitiesByProvince($provinceCode) { }
    public function getDistrictsByCity($cityCode) { }
    public function getVillagesByDistrict($districtCode) { }
}
```

## Troubleshooting

### Error: Class "App\Services\LocationService" not found

**Problem:** Namespace LocationService tidak sesuai dengan lokasi file.

**Solution:**
```bash
composer dump-autoload
php artisan optimize:clear
```

Pastikan namespace di `LocationService.php`:
```php
namespace App\Http\Services;  // ✅ Benar
// bukan
namespace App\Services;       // ❌ Salah
```

### Error: SQLSTATE[42703]: Undefined column "province_id"

**Problem:** Query menggunakan `province_id` tapi database menggunakan `province_code`.

**Solution:** LocationService sudah diperbaiki menggunakan `code`:
```php
// ✅ Benar
City::where('province_code', $provinceCode)

// ❌ Salah
City::where('province_id', $provinceId)
```

### Select2 Tidak Muncul / Tidak Berfungsi

**Problem:** jQuery atau Select2 belum di-load.

**Solution:** Pastikan di layout sudah include:

```blade
@push('styles')
{{-- Select2 CSS --}}
<link href="{{ URL::asset('assets/admin/css/select2-4.1.0/select2.min.css') }}" rel="stylesheet" />
@endpush

@push('scripts')
{{-- jQuery (required for Select2) --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- Select2 JS --}}
<script src="{{ URL::asset('assets/admin/js/select2.min.js') }}"></script>
@endpush
```

### Data Tidak Muncul Saat Edit

**Problem:** Menggunakan `id` bukan `code` untuk selected values.

**Solution:**
```blade
{{-- ❌ Salah --}}
<x-location-selector 
    :selected-province="$data->province_id"
    :selected-city="$data->city_id"
/>

{{-- ✅ Benar --}}
<x-location-selector 
    :selected-province="$data->province_code"
    :selected-city="$data->city_code"
/>
```

### Dropdown Tidak Auto-Enable Setelah Parent Dipilih

**Problem:** JavaScript tidak berjalan atau conflict.

**Solution:**
1. Cek console browser untuk error
2. Pastikan hanya satu instance jQuery di-load
3. Clear browser cache
4. Pastikan `@push('scripts')` di layout sudah ada `@stack('scripts')`

### AJAX Request 404 Not Found

**Problem:** Routes belum terdaftar.

**Solution:** Tambahkan routes di `routes/web.php`:
```php
Route::get('/api/locations/cities', [LocationController::class, 'getCities'])->name('locations.cities');
Route::get('/api/locations/districts', [LocationController::class, 'getDistricts'])->name('locations.districts');
Route::get('/api/locations/villages', [LocationController::class, 'getVillages'])->name('locations.villages');
```

Lalu clear route cache:
```bash
php artisan route:clear
```

### Dark Mode Tidak Berfungsi

**Problem:** Class Tailwind dark mode tidak terdeteksi.

**Solution:** Pastikan `dark:` classes sudah ada di component dan konfigurasi Tailwind sudah benar di `tailwind.config.js`:

```js
module.exports = {
  darkMode: 'class', // atau 'media'
  // ...
}
```

## API Endpoints

### GET /api/locations/cities

Mendapatkan list kabupaten/kota berdasarkan provinsi.

**Query Parameters:**
- `province_code` (required): Kode provinsi

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 123,
            "code": "1101",
            "name": "KAB. ACEH SELATAN"
        }
    ]
}
```

### GET /api/locations/districts

Mendapatkan list kecamatan berdasarkan kabupaten/kota.

**Query Parameters:**
- `city_code` (required): Kode kabupaten/kota

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 456,
            "code": "110101",
            "name": "Bakongan"
        }
    ]
}
```

### GET /api/locations/villages

Mendapatkan list desa/kelurahan berdasarkan kecamatan.

**Query Parameters:**
- `district_code` (required): Kode kecamatan

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 789,
            "code": "11010101",
            "name": "Keude Bakongan"
        }
    ]
}
```

## Database Schema

Component ini menggunakan package **Laravolt Indonesia** dengan struktur tabel:

```
indonesia_provinces
├── id (primary)
├── code (unique)
└── name

indonesia_cities
├── id (primary)
├── code (unique)
├── province_code (foreign)
└── name

indonesia_districts
├── id (primary)
├── code (unique)
├── city_code (foreign)
└── name

indonesia_villages
├── id (primary)
├── code (unique)
├── district_code (foreign)
└── name
```

**Important:** Relasi menggunakan `code` bukan `id`.

## Performance Tips

### 1. Caching

Untuk mempercepat load time, bisa implement caching:

```php
public function getProvinces()
{
    return Cache::remember('provinces', 3600, function () {
        return Province::orderBy('name')->get(['id', 'code', 'name']);
    });
}
```

### 2. Lazy Loading

Untuk form dengan banyak field, pertimbangkan lazy load:

```blade
<x-location-selector 
    :selected-province="$data->province_code ?? null"
    :selected-city="$data->city_code ?? null"
/>
```

### 3. Pagination (untuk dropdown besar)

Jika data terlalu banyak, gunakan Select2 dengan AJAX pagination.

## Contributing

Jika menemukan bug atau ingin menambahkan fitur:

1. Buat issue di repository
2. Fork dan buat branch baru
3. Submit pull request

## Support

Untuk pertanyaan atau bantuan, hubungi tim development.

## License

Component ini merupakan bagian dari project internal dan menggunakan lisensi yang sama dengan aplikasi utama.
