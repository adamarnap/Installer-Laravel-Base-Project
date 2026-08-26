<div class="grid grid-cols-1 xl:grid-cols-2 gap-x-6">

    <!-- Popover -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
        <div class="card-header py-4 px-5 flex items-center justify-between flex-wrap border-b border-borderColor">
            <h5>Four Directions</h5>
        </div>
        <div class="card-body p-5">
            <div class="flex flex-wrap gap-2">
                
                <button data-popover-target="popover-right" data-popover-placement="right" type="button" class="btn btn-outline-primary">Popover Right</button>
                <div data-popover id="popover-right" role="tooltip" class="absolute z-[2000] invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-border-color rounded-lg shadow-sm opacity-0">
                    <div class="px-3 py-2 bg-white border-b border-border-color rounded-t-lg ">
                        <h5 class="font-semibold text-gray-900">Popover Top</h5>
                    </div>
                    <div class="px-3 py-2">
                        <p>And here's some amazing content. It's very engaging. Right?</p>
                    </div>
                    <div data-popper-arrow></div>
                </div>
                <button data-popover-target="popover-default" data-popover-placement="top" type="button" class="btn btn-outline-primary">Popover Top</button>
                <div data-popover id="popover-default" role="tooltip" class="absolute z-[2000] invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-border-color rounded-lg shadow-sm opacity-0">
                    <div class="px-3 py-2 bg-white border-b border-border-color rounded-t-lg ">
                        <h5 class="font-semibold text-gray-900">Popover Top</h5>
                    </div>
                    <div class="px-3 py-2">
                        <p>And here's some amazing content. It's very engaging. Right?</p>
                    </div>
                    <div data-popper-arrow></div>
                </div>
                <button data-popover-target="popover-bottom" data-popover-placement="bottom" type="button" class="btn btn-outline-primary">Popover Bottom</button>
                <div data-popover id="popover-bottom" role="tooltip" class="absolute z-[2000] invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-border-color rounded-lg shadow-sm opacity-0">
                    <div class="px-3 py-2 bg-white border-b border-border-color rounded-t-lg ">
                        <h5 class="font-semibold text-gray-900">Popover Bottom</h5>
                    </div>
                    <div class="px-3 py-2">
                        <p>And here's some amazing content. It's very engaging. Right?</p>
                    </div>
                    <div data-popper-arrow></div>
                </div>
                <button data-popover-target="popover-left" data-popover-placement="left" type="button" class="btn btn-outline-primary">Popover Left</button>
                <div data-popover id="popover-left" role="tooltip" class="absolute z-[2000] invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-border-color rounded-lg shadow-sm opacity-0">
                    <div class="px-3 py-2 bg-white border-b border-border-color rounded-t-lg ">
                        <h5 class="font-semibold text-gray-900">Popover Top</h5>
                    </div>
                    <div class="px-3 py-2">
                        <p>And here's some amazing content. It's very engaging. Right?</p>
                    </div>
                    <div data-popper-arrow></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Popover -->

    <!-- Popover -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
        <div class="card-header py-4 px-5 flex items-center justify-between flex-wrap border-b border-borderColor">
            <h5>Hover and Click Toggle</h5>
        </div>
        <div class="card-body p-5">
            <div class="flex flex-wrap gap-2">
                <button data-popover-target="popover-click" data-popover-trigger="click" data-popover-placement="top" type="button" class="btn bg-primary border border-primary text-white text-center hover:bg-primary-hover hover:text-white">Click to toggle popover</button>
                <div data-popover id="popover-click" role="tooltip" class="absolute z-[2000] invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-border-color rounded-lg shadow-sm opacity-0">
                    <div class="px-3 py-2 bg-white border-b border-border-color rounded-t-lg ">
                        <h5 class="font-semibold text-gray-900">Popover title</h5>
                    </div>
                    <div class="px-3 py-2">
                        <p>And here's some amazing content. It's very engaging. Right?</p>
                    </div>
                    <div data-popper-arrow></div>
                </div>
                <button data-popover-target="popover-hover" data-popover-trigger="hover" data-popover-placement="right" type="button" class="btn bg-primary border border-primary text-white text-center hover:bg-primary-hover hover:text-white">On Hover Tooltip</button>
                <div data-popover id="popover-hover" role="tooltip" class="absolute z-[2000] invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-border-color rounded-lg shadow-sm opacity-0">
                    <div class="px-3 py-2 bg-white border-b border-border-color rounded-t-lg ">
                        <h5 class="font-semibold text-gray-900">Popover title</h5>
                    </div>
                    <div class="px-3 py-2">
                        <p>And here's some amazing content. It's very engaging. Right?</p>
                    </div>
                    <div data-popper-arrow></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Popover -->

</div>

<div class="grid grid-cols-1 xl:grid-cols-2 gap-x-6">
    <!-- Popover -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
        <div class="card-header py-4 px-5 flex items-center justify-between flex-wrap border-b border-borderColor">
            <h5>Colored Popovers</h5>
        </div>
        <div class="card-body p-5">
            <div class="flex flex-wrap gap-2">
                <button data-popover-target="popover-primary" data-popover-placement="top" type="button" class="btn bg-primary border border-primary text-white text-center hover:bg-primary-hover hover:text-white">Primary</button>
                <div data-popover id="popover-primary" role="tooltip" class="absolute z-[2000] invisible inline-block w-64 text-sm text-white transition-opacity duration-300 bg-primary border border-primary rounded-lg shadow-sm opacity-0">
                    <div class="px-3 py-2 bg-primary border-b border-border-color rounded-t-lg ">
                        <h5 class="font-semibold text-white">Color Background</h5>
                    </div>
                    <div class="px-3 py-2">
                        <p>Popover with primary background.</p>
                    </div>
                    <div data-popper-arrow></div>
                </div>
                <button data-popover-target="popover-info" data-popover-placement="top" type="button" class="btn bg-info border border-info text-white text-center hover:bg-info-hover hover:text-white">Info</button>
                <div data-popover id="popover-info" role="tooltip" class="absolute z-[2000] invisible inline-block w-64 text-sm text-white transition-opacity duration-300 bg-info border border-info rounded-lg shadow-sm opacity-0">
                    <div class="px-3 py-2 bg-info border-b border-border-color rounded-t-lg ">
                        <h5 class="font-semibold text-white">Color Background</h5>
                    </div>
                    <div class="px-3 py-2">
                        <p>Popover with info background.</p>
                    </div>
                    <div data-popper-arrow></div>
                </div>
                <button data-popover-target="popover-warning" data-popover-placement="top" type="button" class="btn bg-warning border border-warning text-white text-center hover:bg-warning-900 hover:text-white">Warning</button>
                <div data-popover id="popover-warning" role="tooltip" class="absolute z-[2000] invisible inline-block w-64 text-sm text-white transition-opacity duration-300 bg-warning border border-warning rounded-lg shadow-sm opacity-0">
                    <div class="px-3 py-2 bg-warning border-b border-border-color rounded-t-lg ">
                        <h5 class="font-semibold text-white">Color Background</h5>
                    </div>
                    <div class="px-3 py-2">
                        <p>Popover with warning background.</p>
                    </div>
                    <div data-popper-arrow></div>
                </div>
                <button data-popover-target="popover-success" data-popover-placement="top" type="button" class="btn bg-success border border-success text-white text-center hover:bg-success-900 hover:text-white">Success</button>
                <div data-popover id="popover-success" role="tooltip" class="absolute z-[2000] invisible inline-block w-64 text-sm text-white transition-opacity duration-300 bg-success border border-success rounded-lg shadow-sm opacity-0">
                    <div class="px-3 py-2 bg-success border-b border-border-color rounded-t-lg ">
                        <h5 class="font-semibold text-white">Color Background</h5>
                    </div>
                    <div class="px-3 py-2">
                        <p>Popover with success background.</p>
                    </div>
                    <div data-popper-arrow></div>
                </div>
                <button data-popover-target="popover-danger" data-popover-placement="top" type="button" class="btn bg-danger border border-danger text-white text-center hover:bg-danger-900 hover:text-white">Danger</button>
                <div data-popover id="popover-danger" role="tooltip" class="absolute z-[2000] invisible inline-block w-64 text-sm text-white transition-opacity duration-300 bg-danger border border-danger rounded-lg shadow-sm opacity-0">
                    <div class="px-3 py-2 bg-danger border-b border-border-color rounded-t-lg ">
                        <h5 class="font-semibold text-white">Color Background</h5>
                    </div>
                    <div class="px-3 py-2">
                        <p>Popover with danger background.</p>
                    </div>
                    <div data-popper-arrow></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Popover -->

    <!-- Popover -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
        <div class="card-header py-4 px-5 flex items-center justify-between flex-wrap border-b border-borderColor">
            <h5>Disabled Popover</h5>
        </div>
        <div class="card-body p-5">
            <div class="flex flex-wrap gap-2">
                <button data-popover-target="popover-disable" data-popover-placement="right" type="button" class="btn bg-primary border border-primary text-white text-center hover:bg-primary-hover hover:text-white" disabled>Disabled Button</button>
                <div data-popover id="popover-disable" role="tooltip" class="absolute z-[2000] invisible inline-block w-64 text-sm text-gray-200 transition-opacity duration-300 bg-white border border-border-color rounded-lg shadow-sm opacity-0">
                    <div class="px-3 py-2">
                        <p>Disabled Popover</p>
                    </div>
                    <div data-popper-arrow></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Popover -->

</div>