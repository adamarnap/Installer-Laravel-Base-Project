{{-- Impersonation Bar (di atas topbar) --}}
@if($impersonate_data['is_impersonating'])
<div class="impersonate-bar fixed left-0 right-0 top-0 z-[7] bg-red-500 text-white px-[25px] py-[10px] flex items-center justify-between shadow-md">
    <div class="flex items-center gap-3">
        <i class="material-symbols-outlined text-[22px]">warning</i>
        <span class="text-sm font-medium">
            Anda sedang melakukan impersonate sebagai <strong>{{ $impersonate_data['impersonated_user']->name }}</strong>
            ({{ $impersonate_data['impersonated_user']->email }})
        </span>
    </div>
    <form action="{{ route('settings.impersonate.destroy', $impersonate_data['impersonated_user']->id) }}" method="POST" class="inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-2 bg-white text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200 text-sm font-semibold shadow">
            <i class="material-symbols-outlined text-base">logout</i>
            <span>Keluar dari Impersonate</span>
        </button>
    </form>
</div>

@push('styles')
<style>
    #header-area {
        top: 48px !important;
    }
</style>
@endpush
@endif
