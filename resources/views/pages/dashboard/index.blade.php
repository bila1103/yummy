@extends('layouts.dashboard')

@section('content')
  <div class="row g-3">
    <div class="12 col-lg-8">
      <div class="card card-body">
        <div class="d-flex gap-3 align-items-center">
          <img loading="lazy" height="75"
            src="https://em-content.zobj.net/source/microsoft-teams/363/man-raising-hand-light-skin-tone_1f64b-1f3fb-200d-2642-fe0f.png" />
          <div>
            <h3 class="mb-1"><span class="fw-bold">Hello,</span> {{ auth()->user()->name }}</h3>
            <p class="text-muted mb-0">Welcome to Dashboard!</p>
          </div>
        </div>
      </div>
      <div class="row g-3">
        @foreach ($dashboards as $projectTitle => $project)
          <div class="col-12 col-md-6">
            <div class="card card-body card-dashboard p-3 mb-0">
              <div class="d-flex gap-3 align-items-center">
                <div class="icons"><i class="<?= $project['icon'] ?>"></i></div>
                <div class="info text-truncate">
                  <div class="text-muted small mb-1"><?= $projectTitle ?></div>
                  <h4 class="fw-bold mb-0 countut"><?= $project['count'] ?></h4>
                </div>
              </div>
            </div>
          </div>
        @endforeach
        <div class="col-12">
          <div class="card mb-3">
            <div class="card-header">
              <div class="card-title mb-0">Most Viewed Recipes</div>
            </div>
            <div class="card-body">
              <div id="most-viewed-chart" style="height: 300px;"></div>
            </div>
          </div>
        </div>
        <style>
          .card-dashboard .icons {
            width: 50px;
            height: 50px;
            border-radius: 5px;
            background-color: var(--bs-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #fff;
          }
        </style>
      </div>
    </div>
    <div class="col-12 col-lg-4">
      <div class="card">
        <div class="card-header">
          <div class="card-title mb-0">Recent Recipe</div>
        </div>
        <div class="card-body">
          <ul class="list-unstyled list-unstyled-border mb-0">
            @foreach ($recentRecipes as $key => $recipe)
              <li class="d-flex align-items-center <?= $key != 0 ? 'mt-3' : '' ?>">
                <div class="flex-shrink-0">
                  <img height="50" class="rounded-1" src="{{ $recipe['image'] ?? asset('assets/img/noimage.webp') }}"
                    alt="<?= $recipe['name'] ?? 'Anonymous' ?>" loading="lazy">
                </div>
                <div class="flex-grow-1 ms-2">
                  <a class="fw-medium mb-0 small text-truncate text-black" target="_blank"
                    href="{{ route('detail', $recipe['slug']) }}">
                    {{ $recipe['title'] }}
                  </a>
                  <div class="small">
                    <i class="ri-eye-line text-muted"></i>
                    {{ $recipe['visited_count'] }}
                  </div>
                  <div class="small fw-medium">
                    <?= \Carbon\Carbon::parse($recipe['release_date'])->diffForHumans() ?>
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  {{-- Highcharts CDN --}}
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script>
    const data = @json($mostViewedRecipes);
    const categories = data.map(recipe => recipe.title);
    const seriesData = data.map(recipe => recipe.visited_count);

    document.addEventListener('DOMContentLoaded', function() {
      Highcharts.chart('most-viewed-chart', {
        chart: {
          type: 'column'
        },
        title: {
          text: null
        },
        xAxis: {
          categories: categories,
          title: {
            text: 'Recipe'
          }
        },
        yAxis: {
          min: 0,
          title: {
            text: 'Views'
          }
        },
        legend: {
          enabled: false
        },
        series: [{
          name: 'Views',
          data: seriesData,
          colorByPoint: true
        }],
        credits: {
          enabled: false
        }
      });
    });
  </script>
@endpush
