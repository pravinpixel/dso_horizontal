@extends('layouts.app')
@section('content')
    <div>
        <h1 class="text-primary2">Auto Draw IN Monitor</h1>
        @isset($metrics)
            <div class="row m-0 g-3">
                @foreach ($metrics->all() as $metric)
                    @include('queue-monitor::partials.metrics-card', [
                        'metric' => $metric,
                    ])
                @endforeach
            </div>
        @endisset

        <div class="card border shadow-sm">
            <div class="card-header">
                <b class="text-primary">@lang('Filter')</b>
            </div>
            <div class="card-body">
                <form action="" method="get">
                    <div class="row m-0">
                        <div class="col-5">
                            <div class="row m-0">
                                <label for="filter_show" class="col-3">
                                    @lang('Show jobs')
                                </label>
                                <div class="col">
                                    <select name="type" id="filter_show" class="form-select">
                                        <option @if ($filters['type'] === 'all') selected @endif value="all">
                                            @lang('All')
                                        </option>
                                        <option @if ($filters['type'] === 'running') selected @endif value="running">
                                            @lang('Running')
                                        </option>
                                        <option @if ($filters['type'] === 'failed') selected @endif value="failed">
                                            @lang('Failed')
                                        </option>
                                        <option @if ($filters['type'] === 'succeeded') selected @endif value="succeeded">
                                            @lang('Succeeded')
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="row m-0">
                                <label for="filter_queues" class="col-3">
                                    @lang('Queues')
                                </label>
                                <div class="col">
                                    <select name="queue" id="filter_queues" class="form-select">
                                        <option value="all">All</option>
                                        @foreach ($queues as $queue)
                                            <option @if ($filters['queue'] === $queue) selected @endif
                                                value="{{ $queue }}">
                                                {{ __($queue) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary"> @lang('Filter') </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if (config('queue-monitor.ui.allow_purge'))
            <div class="mt-12">
                <form action="{{ route('queue-monitor::purge') }}" class="text-end" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger rounded-pill px-3 my-4">
                        <i class="fa fa-trash me-2"></i>
                        @lang('Delete all entries')
                    </button>
                </form>
            </div>
        @endif
        <div class="overflow-x-auto shadow-lg">
            <table class="table table-hover table-responsive table-bordered">
                <thead class="bg-gray-200">
                    <tr>
                        <th>@lang('Status')</th>
                        <th>@lang('Job')</th>
                        <th>@lang('Details')</th>
                        @if (config('queue-monitor.ui.show_custom_data'))
                            <th>@lang('Custom Data')</th>
                        @endif
                        <th>@lang('Progress')</th>
                        <th>@lang('Duration')</th>
                        <th>@lang('Started')</th>
                        <th>@lang('Error')</th>
                        @if (config('queue-monitor.ui.allow_deletion'))
                            <th>@lang('Action')</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse($jobs as $job)
                        <tr class="font-sm leading-relaxed">
                            <td class="p-4 text-gray-800 text-sm leading-5 border-b border-gray-200">

                                @if (!$job->isFinished())
                                    <div class="bg-primary badge"> @lang('Running')</div>
                                @elseif($job->hasSucceeded())
                                    <div class="bg-success badge"> @lang('Success')</div>
                                @else
                                    <div class="bg-danger badge"> @lang('Failed')</div>
                                @endif
                            </td>

                            <td class="p-4 text-gray-800 text-sm leading-5 font-medium border-b border-gray-200">

                                {{ $job->getBaseName() }}

                                <span class="ml-1 text-xs text-gray-600">
                                    #{{ $job->job_id }}
                                </span>

                            </td>

                            <td class="p-4 text-gray-800 text-sm leading-5 border-b border-gray-200">

                                <div class="text-xs">
                                    <span class="text-gray-600 font-medium">@lang('Queue'):</span>
                                    <span class="fw-bold">{{ $job->queue }}</span>
                                </div>

                                <div class="text-xs">
                                    <span class="text-gray-600 font-medium">@lang('Attempt'):</span>
                                    <span class="fw-bold">{{ $job->attempt }}</span>
                                </div>

                            </td>

                            @if (config('queue-monitor.ui.show_custom_data'))
                                <td class="p-4 text-gray-800 text-sm leading-5 border-b border-gray-200">

                                    <textarea rows="4" class="w-64 text-xs p-1 border rounded" readonly>{{ json_encode($job->getData(), JSON_PRETTY_PRINT) }}
                                    </textarea>

                                </td>
                            @endif

                            <td class="p-4 text-gray-800 text-sm leading-5 border-b border-gray-200">

                                @if ($job->progress !== null)
                                    <div class="w-32">

                                        <div class="flex items-stretch h-3 rounded-full bg-gray-300 overflow-hidden">
                                            <div class="h-full bg-green-500" style="width: {{ $job->progress }}%"></div>
                                        </div>

                                        <div class="flex justify-center mt-1 text-xs text-gray-800 fw-bold">
                                            {{ $job->progress }}%
                                        </div>

                                    </div>
                                @else
                                    -
                                @endif

                            </td>

                            <td class="p-4 text-gray-800 text-sm leading-5 border-b border-gray-200">
                                {{ $job->getElapsedInterval()->format('%H:%I:%S') }}
                            </td>

                            <td class="p-4 text-gray-800 text-sm leading-5 border-b border-gray-200">
                                {{ $job->started_at->diffForHumans() }}
                            </td>

                            <td class="p-4 text-gray-800 text-sm leading-5 border-b border-gray-200">

                                @if ($job->hasFailed() && $job->exception_message !== null)
                                    <textarea rows="4" class="w-64 text-xs p-1 border rounded" readonly>{{ $job->exception_message }}</textarea>
                                @else
                                    -
                                @endif

                            </td>

                            @if (config('queue-monitor.ui.allow_deletion'))
                                <td class="p-4 text-gray-800 text-sm leading-5 border-b border-gray-200">

                                    <form action="{{ route('queue-monitor::destroy', [$job]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm rounded-pill "><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            @endif

                        </tr>

                    @empty

                        <tr>

                            <td colspan="100" class="">

                                <div class="my-6">

                                    <div class="text-center">

                                        <div class="text-gray-500 text-lg">
                                            @lang('No Jobs')
                                        </div>

                                    </div>

                                </div>

                            </td>

                        </tr>
                    @endforelse

                </tbody>

                <tfoot class="bg-white">

                    <tr>

                        <td colspan="100" class="px-6 py-4 text-gray-700 font-sm border-t-2 border-gray-200">

                            <div class="d-flex justify-content-between align-items-center">

                                <div>
                                    @lang('Showing')
                                    @if ($jobs->total() > 0)
                                        <span class="font-medium">{{ $jobs->firstItem() }}</span> @lang('to')
                                        <span class="font-medium">{{ $jobs->lastItem() }}</span> @lang('of')
                                    @endif
                                    <span class="font-medium">{{ $jobs->total() }}</span> @lang('result')
                                </div>

                                <div>

                                    <a class="border btn btn-sm @if (!$jobs->onFirstPage()) btn-light  @else disabled @endif rounded"
                                        @if (!$jobs->onFirstPage()) href="{{ $jobs->previousPageUrl() }}" @endif>
                                        @lang('Previous')
                                    </a>

                                    <a class="border btn btn-sm @if ($jobs->hasMorePages()) btn-light  @else disabled @endif rounded"
                                        @if ($jobs->hasMorePages()) href="{{ $jobs->url($jobs->currentPage() + 1) }}" @endif>
                                        @lang('Next')
                                    </a>

                                </div>

                            </div>

                        </td>

                    </tr>

                </tfoot>

            </table>

        </div>
    </div>
@endsection
