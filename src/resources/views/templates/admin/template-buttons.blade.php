{{-- Start: Button Mini For in Table --}}
{{-- Btn Detail --}}
<a href="product-details.html" class="btn w-[30px] h-[30px] flex items-center justify-center border rounded-[5px] text-primary-700 hover:bg-light-900 hover:text-primary">
    <i class="ti ti-eye text-[16px]"></i>
</a>
{{-- Btn Edit --}}
<a href="edit-product.html" class="btn w-[30px] h-[30px] flex items-center justify-center border rounded-[5px] text-warning-700 hover:bg-light-900 hover:text-primary">
    <i class="ti ti-edit text-[16px]"></i>
</a>
{{-- Btn Delete --}}
<a href="#" id="btn-delete" class="btn w-[30px] h-[30px] flex items-center justify-center border rounded-[5px] text-danger-700 hover:bg-light-900 hover:text-primary">
    <i class="ti ti-trash text-[16px]"></i>
</a>
{{-- End: Button Mini For in Table --}}


{{-- Start: Button For General --}}
<a href="add-product.html" class="btn flex items-center gap-1 btn bg-primary border border-primary text-white text-center hover:bg-primary-hover hover:text-white">
    <i class="ti ti-circle-plus"></i>Add Product
</a>
{{-- End: Button For General --}}

{{-- Start: Dropdown Button --}}
<div class="grid grid-cols-1 gap-6">
    <div class="col-span-12">
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
            <div class="card-header border-b p-4 border-borderColor">
                <div class="card-title">
                    Dropdowns
                </div>
            </div>
            <div class="card-body p-4 flex items-center">
                <div class="dropdown me-2">
                    <button class="btn bg-primary border border-primary text-white text-center hover:bg-primary-hover hover:text-white dropdown-toggle" type="button"
                        data-dropdown-toggle="dropdown1" aria-expanded="false">
                        Dropdowns
                        <i class="ti ti-chevron-down ml-1"></i>
                    </button>
                    <ul class="dropdown-menu border rounded bg-white shadow-lg w-40 z-[1] hidden" id="dropdown1">
                        <li><a class="dropdown-item rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900" href="#">Action</a></li>
                        <li><a class="dropdown-item rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900" href="#">Another action</a></li>
                        <li><a class="dropdown-item rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900" href="#">Something else here</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <a class="btn bg-secondary border border-secondary text-white text-center hover:bg-secondary-hover hover:text-white dropdown-toggle text-white" href="#" role="button"
                        data-dropdown-toggle="dropdown2" aria-expanded="false">
                        Dropdown Link
                        <i class="ti ti-chevron-down ml-1"></i>
                    </a>
                    <ul class="dropdown-menu border rounded bg-white shadow-lg w-40 z-[1] hidden" id="dropdown2">
                        <li><a class="dropdown-item rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900" href="#">Action</a></li>
                        <li><a class="dropdown-item rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900" href="#">Another action</a></li>
                        <li><a class="dropdown-item rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900" href="#">Something else here</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End: Dropdown Button --}}