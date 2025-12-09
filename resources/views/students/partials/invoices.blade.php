<div class="grid grid-cols-1">
    <div class="overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Student Invoices</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dataTable">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">
                            ID
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">
                            Section
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">
                            Amount Paid
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">
                            Balance
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">
                            Due Date
                        </th>

                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">

                    @foreach ($model->invoices as $invoice)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-md font-medium text-gray-500">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $invoice->studentSection->section->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-md font-medium text-gray-500">
                                {{ $invoice->amount_paid }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-md font-medium text-gray-500">
                                {{ $invoice->balance }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-md font-medium text-gray-500">
                                {{ $invoice->due_date }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
