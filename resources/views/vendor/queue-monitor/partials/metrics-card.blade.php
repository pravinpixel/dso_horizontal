<div class="mb-4 col">
    <div class="card border shadow-sm ">
        <div class="card-header" title="{{ __('Last :days days', ['days' => config('queue-monitor.ui.metrics_time_frame') ?? 14]) }}">
            <div class="card-title m-0 text-primary">
                <h4>{{ __($metric->title) }}</h4>
            </div>
        </div>
        <div class="card-body d-flex">
            <h3 class="m-0 text-dark me-3"> {{ $metric->format($metric->value) }} </h3>
            @if($metric->previousValue !== null)
                <div class="mt-2 {{ $metric->hasChanged() ? ($metric->hasIncreased() ? 'text-sccuess' : 'text-danger') : 'text-secondary' }}">
                    @if($metric->hasChanged())
                        @if($metric->hasIncreased())
                            @lang('Up from')
                        @else
                            @lang('Down from')
                        @endif
                    @else
                        @lang('No change from')
                    @endif
                    {{ $metric->format($metric->previousValue) }}
                </div>
            @endif
        </div>
    </div>
</div>
