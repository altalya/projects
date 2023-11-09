<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <style>
        button{
            height: 50px;
            width: 20%;
            color: white;
            font-size: 20px;
            border-radius: 10px;
            margin-top: 2%;
            margin-left: 40%;
            margin-bottom: 3%;
            background-color: blue; 
        }
        #h1{
            font-size: 30px;
            text-align: center;
            margin-bottom: 2%;
            font-weight: 600;
        }
        .p-6{
            padding-left: 10;
        }
    </style>
        
    <div class="py-12" >
            <h1 id="h1">welcome Admin - {{Auth::user()->name}} !..</h1>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!!..") }}
                </div>
            </div>
        </div>
        <a href="list"><button>Admin Details</button></a>
    </div>
</x-app-layout>
