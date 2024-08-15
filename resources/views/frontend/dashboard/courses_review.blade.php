@extends('frontend.dashboard.layouts.master')

@section('content')

<style>
  .review-section {
    margin-bottom: 2rem;
  }

  .course-card {
    border: 1px solid #ddd;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    margin-bottom: 2rem;
  }

  .course-card .card-body {
    padding: 1.5rem;
  }

  .course-card .course-title {
    font-size: 1.5rem;
    margin-bottom: 1rem;
    font-weight: bold;
  }

  .course-card .review-list .review-card {
    margin-bottom: 1.5rem;
  }

  .course-card .review-card .card-body {
    padding: 1.5rem;
  }

  .course-card .rating-stars {
    color: #ffc107;
  }

  .course-card .rating-stars i {
    margin-right: 2px;
  }

  .review-form label {
    font-weight: bold;
  }

  .review-form .rating {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
  }

  .review-form .rating input[type="radio"] {
    display: none;
  }

  .review-form .rating label {
    font-size: 2rem;
    color: #ddd;
    cursor: pointer;
  }

  .review-form .rating input[type="radio"]:checked ~ label {
    color: #ffc107;
  }

  .review-form .rating input[type="radio"]:hover ~ label,
  .review-form .rating label:hover,
  .review-form .rating label:hover ~ label {
    color: #ffc107;
  }
</style>

<section id="wsus__dashboard" class="py-5">
  <div class="container-fluid">
    @include('frontend.dashboard.layouts.sidebar')

    <div class="row">
      <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
        <div class="dashboard_content mt-2 mt-md-0">
          <h3 class="mb-4"><i class="fas fa-star"></i> รีวิวคอร์สเรียนของฉัน</h3>

          @if (session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
          @endif

          @if (session('error'))
            <div class="alert alert-danger">
              {{ session('error') }}
            </div>
          @endif

          @foreach ($mycourses as $mycourse)
            <div class="course-card card">
              <div class="card-body">
                <h4 class="course-title">รีวิวคอร์ส: {{ $mycourse->name }}</h4>
                
                <!-- Display only the user's review -->
                @php
                  $userReview = $mycourse->reviews->where('user_id', Auth::id())->first();
                @endphp

                @if ($userReview)
                  <div class="review-list">
                    <div class="card review-card">
                      <div class="card-body">
                        <h5 class="card-title">{{ $userReview->user->name }}</h5>
                        <div class="rating-stars">
                          @for ($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star{{ $i <= $userReview->rating ? '' : '-o' }}"></i>
                          @endfor
                        </div>
                        <p class="card-text">{{ $userReview->comment }}</p>
                        <small class="text-muted">รีวิวเมื่อ: {{ $userReview->created_at->format('d/m/Y') }}</small>
                      </div>
                    </div>
                  </div>
                @else
                  <!-- Review form -->
                  <div class="review-form mt-5">
                      <h4>เพิ่มรีวิวของคุณ</h4>
                      <form action="{{ route('user.courses.storeReview', ['course' => $mycourse->id]) }}" method="POST">
                        @csrf
                        
                        <!-- Rating -->
                        <div class="form-group">
                          <label for="rating-{{ $mycourse->id }}">คะแนนของคุณ:</label>
                          <div class="rating">
                            @for ($i = 5; $i >= 1; $i--)
                              <input type="radio" name="rating" id="rating-{{ $mycourse->id }}-{{ $i }}" value="{{ $i }}">
                              <label for="rating-{{ $mycourse->id }}-{{ $i }}"><i class="fas fa-star"></i></label>
                            @endfor
                          </div>
                        </div>
                      
                        <!-- Comment -->
                        <div class="form-group">
                          <label for="comment-{{ $mycourse->id }}">ความคิดเห็นของคุณ:</label>
                          <textarea name="comment" id="comment-{{ $mycourse->id }}" class="form-control" rows="5" required></textarea>
                        </div>
                      
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary mt-3">ส่งรีวิว</button>
                      </form>
                  </div>
                @endif
              </div>
            </div>
          @endforeach
          
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
