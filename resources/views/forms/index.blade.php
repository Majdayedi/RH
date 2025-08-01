@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold">Forms</h1>
        <a href="{{ route('form') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> New Form
        </a>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <ul role="list" class="divide-y divide-gray-200">
            @foreach ($forms as $form)
                <li>
                    <div class="block hover:bg-gray-50">
                        <div class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-indigo-600 truncate">
                                    {{ $form->title }}
                                </p>
                                <div class="ml-2 flex-shrink-0 flex">
                                    <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full @if($form->published) bg-green-100 text-green-800 @else bg-yellow-100 text-yellow-800 @endif">
                                        {{ $form->published ? 'Published' : 'Draft' }}
                                    </p>
                                </div>
                            </div>
                            <div class="mt-2 sm:flex sm:justify-between">
                                <div class="sm:flex">
                                    <p class="flex items-center text-sm text-gray-500">
                                        {{ $form->description }}
                                    </p>
                                </div>
                                <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                    <p>
                                        Created on {{ $form->created_at->format('M d, Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
