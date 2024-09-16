@extends('frontend.layouts.master')

@section('content')
<div class="container mt-6" style="margin-left:5%">
    <div class="row">
        <div class="col mt-3">
            <div class="content d-flex flex-column" style="padding: 2%;">
                <div class="row mt-3" style="margin-top:30px; padding: 1%;">

                    {{-- Start ตัวกรอง --}}
                    <div class="menu" style="width:25%; margin-left:40px">
                        <div class="price mt-3 mb-3" style="display: flex; align-items: center;">
                            <img src="{{$course->teacher->image}}" alt="" style="border-radius: 50%; width: 50px; height: 50px; margin-right: 10px;">
                            <a href="{{route('teacher-detail', ['id' => $course->teacher_id])}}"><h5>{{$course->teacher->firstname}} {{$course->teacher->lastname}}</h5></a>
                        </div>

                        <div class="divider" style="width: 90%;"></div>

                        @if($hasPurchased)
                            <a href="{{ route('user.learn_course.lesson', ['course' => $course->id, 'lesson' => $course->lessons->first()->slug]) }}" class="btn btn-success">เรียน</a>
                        @else
                            <a href="{{route('user.course_purchase', ['course' => $course->id])}}" class="btn btn-primary">ซื้อคอร์ส</a>
                        @endif
                    </div>
                    {{-- End ตัวกรอง --}}

                    <div class="card-corse col-md-8 justify-content-center" style="margin-left:55px">
                        <div class="corse-search" style="padding:10px;">
                            <div class="row">
                                <div class="text-search col-md-9 my-3">
                                    <img src="{{$course->image}}" alt="" width="100px">
                                    <h5 class="mt-2">{{$course->name}}</h5>
                                    <h6>จำนวน {{$course->lessons->count()}} บทเรียน ระดับ {{$course->level}} เวลา {{$course->hours}} ชม.
                                        คะแนน {{ $course->reviewSummary ? $course->reviewSummary->average_rating : '-' }}
                                    </h6>
                                </div>
                                <div class="col-md-3 my-4">
                                    <div style="margin-left: 45%">
                                        <h4>{{$course->price}} บาท</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="course d-flex">
                            <div class="row">
                                {!! $course->content !!}
                            </div>
                        </div>

                        {{-- Start Reviews Section --}}
                        <div class="reviews mt-4">
                            <h4>รีวิวของผู้ใช้</h4>
                            @if($reviews->count())
                                @foreach ($reviews as $review)
                                    <div class="review-card mb-3 p-3 border rounded">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ $review->user->image ?? asset('images/user-profile.jpg') }}" alt="" class="rounded-circle" style="width: 40px; height: 40px; margin-right: 10px;">
                                            <strong>{{ $review->user->name }}</strong>
                                        </div>
                                        <div class="rating-stars mb-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                                            @endfor
                                        </div>
                                        <p>{{ $review->comment }}</p>
                                        <small class="text-muted">รีวิวเมื่อ: {{ $review->created_at->format('d/m/Y') }}</small>
                                    </div>
                                @endforeach
                                
                                @if($totalReviews > 3)
                                    <button id="loadMoreReviews" class="btn btn-secondary mt-3">ดูรีวิวเพิ่มเติม</button>
                                @endif
                            @else
                                <p>ยังไม่มีรีวิวสำหรับคอร์สนี้</p>
                            @endif
                        </div>
                        {{-- End Reviews Section --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var loadMoreButton = document.getElementById('loadMoreReviews');
        var reviewsSection = document.querySelector('.reviews');

        if (loadMoreButton) {
            loadMoreButton.addEventListener('click', function() {
                fetch('{{ route('course-reviews', ['id' => $course->id]) }}')
                    .then(response => response.json())
                    .then(data => {
                        if (data.reviews.length) {
                            data.reviews.forEach(review => {
                                var reviewCard = `
                                    <div class="review-card mb-3 p-3 border rounded">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="${review.user_image}" alt="" class="rounded-circle" style="width: 40px; height: 40px; margin-right: 10px;">
                                            <strong>${review.user_name}</strong>
                                        </div>
                                        <div class="rating-stars mb-2">
                                            ${'⭐'.repeat(review.rating)}
                                        </div>
                                        <p>${review.comment}</p>
                                        <small class="text-muted">รีวิวเมื่อ: ${review.created_at}</small>
                                    </div>
                                `;
                                reviewsSection.insertAdjacentHTML('beforeend', reviewCard);
                            });
                            
                            if (!data.hasMore) {
                                loadMoreButton.remove();
                            }
                        }
                    });
            });
        }
    });
</script>
@endpush
@endsection
