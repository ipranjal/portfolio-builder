@if(app()->session()->has('success'))
@foreach (app()->session()->flash('success') as $msg)
<div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
    <div>
      {{ $msg }}
    </div>
</div>
@endforeach
@endif

@if(app()->session()->has('error'))
@foreach (app()->session()->flash('error') as $msg)
<div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
    <div>
      {{ $msg }}
    </div>
</div>
@endforeach
@endif