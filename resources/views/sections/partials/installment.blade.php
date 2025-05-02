<div class="grid grid-cols-1 mx-auto">
    <div class="overflow-hidden">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Section Installment</h2>
            <button data-modal-target="add-installment-modal" data-modal-toggle="add-installment-modal"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                <i class="fas fa-plus-circle"></i>
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">
                            ID
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">
                            Installment
                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">
                            Amount
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">
                            Currency
                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-right text-md font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">

                    @foreach ($model->sectionInstallments as $sectionInstallment)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-md font-medium text-gray-900">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-500">
                                {{ $sectionInstallment->installment->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-500">
                                {{ $sectionInstallment->amount }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-500">
                                {{ $sectionInstallment->currency }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-md font-medium">
                                @can('edit-installment')
                                    <button type="button" data-modal-target="edit-installment-modal-{{ $sectionInstallment->id }}"
                                        data-modal-toggle="edit-installment-modal-{{ $sectionInstallment->id }}"
                                        class="text-yellow-600 hover:text-yellow-900 mr-4">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                @endcan
                                @can('delete-installment')
                                    <form
                                        action="{{ route('installments.destroy', ['section' => $model, 'installment' => $sectionInstallment]) }}"
                                        style="display: inline-block" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:text-red-900 delete-btn">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>

                        {{-- Edit Installment Modal --}}
                        <div id="edit-installment-modal-{{ $sectionInstallment->id }}" tabindex="-1" aria-hidden="true"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow-sm">
                                    <form
                                        action="{{ route('installments.update', ['installment' => $sectionInstallment, 'section' => $model]) }}"
                                        method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 rounded-t border-gray-200">
                                            <h3 class="text-xl font-semibold text-gray-900">
                                                Edit Section Installment
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="edit-installment-modal-{{ $sectionInstallment->id }}">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <div class="p-4 md:p-5 space-y-4">
                                            <div class="grid grid-cols-1">
                                                <input type="hidden" name="section_id" value="{{ $model->id }}">
                                                <div class="mb-4">
                                                    <label for="name-{{ $sectionInstallment->id }}"
                                                        class="block text-sm font-medium text-gray-700">Name</label>
                                                    <input type="text" name="name"
                                                        id="name-{{ $sectionInstallment->id }}"
                                                        value="{{ $sectionInstallment->name }}" required
                                                        class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                                                </div>
                                                <div class="mb-4">
                                                    <label for="amount-{{ $sectionInstallment->id }}"
                                                        class="block text-sm font-medium text-gray-700">Amount</label>
                                                    <input type="number" name="amount"
                                                        id="amount-{{ $sectionInstallment->id }}"
                                                        value="{{ $sectionInstallment->amount }}" required
                                                        class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                                                </div>
                                                <div class="mb-4">
                                                    <label for="currency-{{ $sectionInstallment->id }}"
                                                        class="block text-sm font-medium text-gray-700">Currency</label>
                                                    <select name="currency" id="currency-{{ $sectionInstallment->id }}"
                                                        required
                                                        class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                                                        <option value="USD"
                                                            {{ $sectionInstallment->currency == 'USD' ? 'selected' : '' }}>USD
                                                        </option>
                                                        <option value="LRD"
                                                            {{ $sectionInstallment->currency == 'LRD' ? 'selected' : '' }}>LRD
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4">
                                                <div class="mb-4">
                                                    <label for="start_date-{{ $sectionInstallment->id }}"
                                                        class="block text-sm font-medium text-gray-700">Start
                                                        Date</label>
                                                    <input type="date" name="start_date"
                                                        id="start_date-{{ $sectionInstallment->id }}"
                                                        value="{{ $sectionInstallment->start_date }}" required
                                                        class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                                                </div>
                                                <div class="mb-4">
                                                    <label for="end_date-{{ $sectionInstallment->id }}"
                                                        class="block text-sm font-medium text-gray-700">End
                                                        Date</label>
                                                    <input type="date" name="end_date"
                                                        id="end_date-{{ $sectionInstallment->id }}"
                                                        value="{{ $sectionInstallment->end_date }}" required
                                                        class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="flex items-center p-4 md:p-5 rounded-b">
                                            <button type="submit"
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
                                            <button data-modal-hide="edit-installment-modal-{{ $sectionInstallment->id }}"
                                                type="button"
                                                class="py-2.5 px-5 ms-3 text-sm font-medium focus:outline-none bg-red-600 rounded-lg border border-gray-200 hover:bg-red-700 text-white">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>




{{-- Add Installment Modal --}}
<div id="add-installment-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm ">
            <form action="{{ route('installments.create', ['section' => $model]) }}" method="POST">
                @csrf
                <div class="flex items-center justify-between p-4 md:p-5  rounded-t  border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Add Section Installment
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="add-installment-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-4 md:p-5 space-y-4">
                    <div class="grid grid-cols-1">
                        <input type="hidden" name="section_id" value="{{ $model->id }}">
                        <div class="mb-4">
                            <label for="installment_id"
                                class="block text-sm font-medium text-gray-700">Installment</label>
                            <select name="installment_id" required
                                class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                                @foreach ($installments as $installment)
                                    <option value="{{ $installment->id }}">{{ $installment->name }}</option>
                                @endforeach
                            </select>
                            @error('installment_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                            <input type="number" name="amount" id="amount" required
                                class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                            @error('amount')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="currency" class="block text-sm font-medium text-gray-700">Currency</label>
                            <select name="currency" required
                                class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                                <option value="USD">USD</option>
                                <option value="LRD">LRD</option>
                            </select>
                            @error('currency')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4">
                        <div class="mb-4">
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input type="date" name="start_date" required
                                class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                            @error('start_date')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                            <input type="date" name="end_date" required
                                class="mt-1 block w-full p-4 border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                            @error('end_date')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 rounded-b ">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                    <button data-modal-hide="add-installment-modal" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium  focus:outline-none bg-red-600 rounded-lg border border-gray-200 hover:bg-red-700 text-white">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End of Add Installment Modal --}}
