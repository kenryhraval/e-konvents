<x-layouts.items>
    <x-slot name="title">
        {{__('Taken Items')}}
    </x-slot>

    <div class="max-w-6xl mx-auto py-5">

        @if($taken->isEmpty())
            <div class="flex justify-center items-center h-40">
                <h3 class="italic text-gray-600 text-lg">
                    {{__('No records meet the criteria')}}
                </h3>
            </div>

        @else
        <div class="overflow-x-auto ">
            <table class="min-w-full bg-white border border-gray-300 rounded-md">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="px-4 py-2 border">{{__('User')}}</th>
                        <th class="px-4 py-2 border">{{__('Item')}}</th>
                        <th class="px-4 py-2 border">{{__('Count')}}</th>
                        <th class="px-4 py-2 border">{{__('Reason')}}</th>
                        <th class="px-4 py-2 border">{{__('Date')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($taken as $entry)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $entry->user->name }}</td>
                            <td class="px-4 py-2 border">{{ $entry->item->name }}</td>
                            <td class="px-4 py-2 border">{{ $entry->count }}</td>
                            <td class="px-4 py-2 border">{{ $entry->reason }}</td>
                            <td class="px-4 py-2 border">{{ $entry->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</x-layouts.items>
