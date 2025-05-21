<x-layout.app>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Recovery Report</h2>
        <div style="display: flex;">
            
            <div style="width: 33.33%;">
                <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Start Date</span>
                    <input data-message="member_field_message" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="shahmir ahsanullah">
                    <span class="member_field_message text-xs text-red-600 dark:text-red-400" style="display: none;"> Member's field is required </span>
                </label>
            </div>
            <div style="width: 33.33%;">
                <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">End Date</span>
                    <input data-message="member_field_message" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="shahmir ahsanullah">
                    <span class="member_field_message text-xs text-red-600 dark:text-red-400" style="display: none;"> Member's field is required </span>
                </label>
            </div>
        </div>
    </div>
</x-layout.app>