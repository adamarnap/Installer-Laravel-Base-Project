<div class="card">
    <div class="card-header block">
        <h4 class="card-title mb-1.25">Choices.Js</h4>
        <p class="text-default-400">Choices.js is a lightweight, configurable select box/text input plugin. Similar to Select2 and Selectize but without the jQuery dependency.</p>
    </div>

    <div class="card-body">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-base">
            <div>
                <h5 class="mb-2 text-sm">Single Select Input: Default</h5>
                <p class="text-default-400">
                    Set
                    <code>data-choices</code>
                    attribute to set a default single select.
                </p>
            </div>
            <div>
                <select class="form-input" data-choices name="choices-single-default" id="choices-single-default">
                    <option value="">This is a placeholder</option>
                    <option value="Choice 1">Choice 1</option>
                    <option value="Choice 2">Choice 2</option>
                    <option value="Choice 3">Choice 3</option>
                </select>
            </div>
        </div>

        <hr class="border-default-300 my-7.5 border-dashed" />

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-base">
            <div>
                <h5 class="mb-2 text-sm">Single Select Input: Option Groups</h5>
                <p class="text-default-400">
                    Set
                    <code>data-choices data-choices-groups</code>
                    attribute to set option group
                </p>
            </div>
            <div>
                <select class="form-input" id="choices-single-groups" data-choices data-choices-groups data-placeholder="Select City" name="choices-single-groups">
                    <option value="">Choose a city</option>
                    <optgroup label="UK">
                        <option value="London">London</option>
                        <option value="Manchester">Manchester</option>
                        <option value="Liverpool">Liverpool</option>
                    </optgroup>
                    <optgroup label="FR">
                        <option value="Paris">Paris</option>
                        <option value="Lyon">Lyon</option>
                        <option value="Marseille">Marseille</option>
                    </optgroup>
                    <optgroup label="DE" disabled>
                        <option value="Hamburg">Hamburg</option>
                        <option value="Munich">Munich</option>
                        <option value="Berlin">Berlin</option>
                    </optgroup>
                    <optgroup label="US">
                        <option value="New York">New York</option>
                        <option value="Washington" disabled>Washington</option>
                        <option value="Michigan">Michigan</option>
                    </optgroup>
                    <optgroup label="SP">
                        <option value="Madrid">Madrid</option>
                        <option value="Barcelona">Barcelona</option>
                        <option value="Malaga">Malaga</option>
                    </optgroup>
                    <optgroup label="CA">
                        <option value="Montreal">Montreal</option>
                        <option value="Toronto">Toronto</option>
                        <option value="Vancouver">Vancouver</option>
                    </optgroup>
                </select>
            </div>
        </div>

        <hr class="border-default-300 my-7.5 border-dashed" />

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-base">
            <div>
                <h5 class="mb-2 text-sm">Single Select Input: No Search</h5>
                <p class="text-default-400">
                    Set
                    <code>data-choices data-choices-search-false data-choices-removeItem</code>
                </p>
            </div>
            <div>
                <select class="form-input" id="choices-single-no-search" name="choices-single-no-search" data-choices data-choices-search-false data-choices-removeItem>
                    <option value="Zero">Zero</option>
                    <option value="One">One</option>
                    <option value="Two">Two</option>
                    <option value="Three">Three</option>
                    <option value="Four">Four</option>
                    <option value="Five">Five</option>
                    <option value="Six">Six</option>
                </select>
            </div>
        </div>

        <hr class="border-default-300 my-7.5 border-dashed" />

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-base">
            <div>
                <h5 class="mb-2 text-sm">Single Select Input: No Sorting</h5>
                <p class="text-default-400">
                    Set
                    <code>data-choices data-choices-sorting-false</code>
                    attribute.
                </p>
            </div>
            <div>
                <select class="form-input" id="choices-single-no-sorting" name="choices-single-no-sorting" data-choices data-choices-sorting-false>
                    <option value="Madrid">Madrid</option>
                    <option value="Toronto">Toronto</option>
                    <option value="Vancouver">Vancouver</option>
                    <option value="London">London</option>
                    <option value="Manchester">Manchester</option>
                    <option value="Liverpool">Liverpool</option>
                    <option value="Paris">Paris</option>
                    <option value="Malaga">Malaga</option>
                    <option value="Washington" disabled>Washington</option>
                    <option value="Lyon">Lyon</option>
                    <option value="Marseille">Marseille</option>
                    <option value="Hamburg">Hamburg</option>
                    <option value="Munich">Munich</option>
                    <option value="Barcelona">Barcelona</option>
                    <option value="Berlin">Berlin</option>
                    <option value="Montreal">Montreal</option>
                    <option value="New York">New York</option>
                    <option value="Michigan">Michigan</option>
                </select>
            </div>
        </div>

        <hr class="border-default-300 my-7.5 border-dashed" />

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-base">
            <div>
                <h5 class="mb-2 text-sm">Multiple Select Input: Default</h5>
                <p class="text-default-400">
                    Set
                    <code>data-choices multiple</code>
                    attribute.
                </p>
            </div>
            <div>
                <select class="form-input" id="choices-multiple-default" data-choices name="choices-multiple-default" multiple>
                    <option value="Choice 1" selected>Choice 1</option>
                    <option value="Choice 2">Choice 2</option>
                    <option value="Choice 3">Choice 3</option>
                    <option value="Choice 4" disabled>Choice 4</option>
                </select>
            </div>
        </div>

        <hr class="border-default-300 my-7.5 border-dashed" />

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-base">
            <div>
                <h5 class="mb-2 text-sm">Multiple Select Input: With Remove Button</h5>
                <p class="text-default-400">
                    Set
                    <code>data-choices data-choices-removeItem multiple</code>
                    attribute.
                </p>
            </div>
            <div>
                <select class="form-input" id="choices-multiple-remove-button" data-choices data-choices-removeItem name="choices-multiple-remove-button" multiple>
                    <option value="Choice 1" selected>Choice 1</option>
                    <option value="Choice 2">Choice 2</option>
                    <option value="Choice 3">Choice 3</option>
                    <option value="Choice 4">Choice 4</option>
                </select>
            </div>
        </div>

        <hr class="border-default-300 my-7.5 border-dashed" />

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-base">
            <div>
                <h5 class="mb-2 text-sm">Multiple Select Input: Option Groups</h5>
                <p class="text-default-400">
                    Set
                    <code>data-choices data-choices-multiple-groups="true" multiple</code>
                    attribute.
                </p>
            </div>
            <div>
                <select class="form-input" id="choices-multiple-groups" name="choices-multiple-groups" data-choices data-choices-multiple-groups="true" multiple>
                    <option value="">Choose a city</option>
                    <optgroup label="UK">
                        <option value="London">London</option>
                        <option value="Manchester">Manchester</option>
                        <option value="Liverpool">Liverpool</option>
                    </optgroup>
                    <optgroup label="FR">
                        <option value="Paris">Paris</option>
                        <option value="Lyon">Lyon</option>
                        <option value="Marseille">Marseille</option>
                    </optgroup>
                    <optgroup label="DE" disabled>
                        <option value="Hamburg">Hamburg</option>
                        <option value="Munich">Munich</option>
                        <option value="Berlin">Berlin</option>
                    </optgroup>
                    <optgroup label="US">
                        <option value="New York">New York</option>
                        <option value="Washington" disabled>Washington</option>
                        <option value="Michigan">Michigan</option>
                    </optgroup>
                    <optgroup label="SP">
                        <option value="Madrid">Madrid</option>
                        <option value="Barcelona">Barcelona</option>
                        <option value="Malaga">Malaga</option>
                    </optgroup>
                    <optgroup label="CA">
                        <option value="Montreal">Montreal</option>
                        <option value="Toronto">Toronto</option>
                        <option value="Vancouver">Vancouver</option>
                    </optgroup>
                </select>
            </div>
        </div>

        <hr class="border-default-300 my-7.5 border-dashed" />

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-base">
            <div>
                <h5 class="mb-2 text-sm">Text Input: Limit Values with Remove Button</h5>
                <p class="text-default-400">
                    Set
                    <code>data-choices data-choices-limit="3" data-choices-removeItem</code>
                    attribute.
                </p>
            </div>
            <div>
                <input class="form-input" id="choices-text-remove-button" data-choices data-choices-limit="3" data-choices-removeItem type="text" value="Task-1" />
            </div>
        </div>

        <hr class="border-default-300 my-7.5 border-dashed" />

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-base">
            <div>
                <h5 class="mb-2 text-sm">Text Input: Unique Values Only</h5>
                <p class="text-default-400">
                    Set
                    <code>data-choices data-choices-text-unique-true</code>
                    attribute.
                </p>
            </div>
            <div>
                <input class="form-input" id="choices-text-unique-values" data-choices data-choices-text-unique-true type="text" value="Project-A, Project-B" />
            </div>
        </div>

        <hr class="border-default-300 my-7.5 border-dashed" />

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-base">
            <div>
                <h5 class="mb-2 text-sm">Text Input: Disabled</h5>
                <p class="text-default-400">
                    Set
                    <code>data-choices data-choices-text-disabled-true</code>
                    attribute.
                </p>
            </div>
            <div>
                <input class="form-input" id="choices-text-disabled" data-choices data-choices-text-disabled-true type="text" value="josh&#64;joshuajohnson.co.uk, joe&#64;bloggs.co.uk" />
            </div>
        </div>
    </div>
    <!-- end card-body-->
</div>


{{-- Start: Script --}}
<!-- Choices Demo Js-->
<script src="{{ URL::asset('assets/js/pages/form-choice.js') }}"></script>
{{-- End: Script --}}