@props(['breadcrumbItems' => []])

<div class="flex py-3 items-center ">
    <ul class="list-none space-x-1 flex flex-wrap items-center pl-0 pr-3 py-1 ">
        <li class="inline-block items-center relative text-sm text-gray-500">
            <a href="{{ route('admin.dashboard') }}" class="breadcrumbList">
                <i class="fa fa-home"></i>
                @if (!empty($breadcrumbItems))
                    <i class="fa fa-chevron-right relative text-gray-500 text-sm rtl:rotate-180"></i>
                @endif
            </a>
        </li>

        @foreach($breadcrumbItems as $breadcrumbItem)
            <li class="inline-block text-gray-500 text-sm font-light {{ $breadcrumbItem['active'] ? 'breadcrumbActive dark:text-slate-300 text-[#4644D3]' : 'relative text-sm text-gray-500' }}">
                <a href="{{ $breadcrumbItem['url'] }}" class="breadcrumbList">
                    {{ __($breadcrumbItem['name']) }}
                    @if(!$loop->last)
                        <i class="fa fa-chevron-right relative text-[#4644D3] text-sm rtl:rotate-180"></i>
                    @endif
                </a>
            </li>
        @endforeach
    </ul>
</div>
