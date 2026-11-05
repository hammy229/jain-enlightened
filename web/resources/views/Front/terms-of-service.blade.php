
@section('meta-header')
@section('title',!empty($metadata->meta_title)?$metadata->meta_title:'')

@section('meta_description',!empty($metadata->meta_description)?$metadata->meta_description:'')

@section('meta_keywords', !empty($metadata->meta_keyword)?$metadata->meta_keyword:'')

@include ("Front.includes.header")

    <!-- Page header Start -->
    {{-- <div class="page-header parallaxie" style="background-image: url('front/images/page-banners/podcasts.jpg')"> --}}
        <div class="page-header parallaxie" style="background-image: url('{{ !empty($banner->ban_image_path) ? url('/') . Storage::url($banner->ban_image_path) : asset('front/images/page-banners/podcasts.jpg') }}');">
        {{-- </div> --}}
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- Page Header box Start -->
                    <div class="page-header-box">
                   
                        <h2 class="text-anime-style-3">{{ !empty($banner->heading) ? $banner->heading : 'Terms and Condition' }}</h2>                              
                        <nav class="wow fadeInUp" data-wow-delay="0.25s">
                            <ol class="breadcrumb">
                                <li><a href="{{URL::asset('/')}}">Home</a></li>
                                <li> Terms and Condition</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="publishings-section">
        <div class="container">

              <div class="privacy-policy-content"> <span> {!! !empty($term->description) ? $term->description : '' !!} </span> </div>


            {{-- <div class="privacy-policy-content">
                <h2 class="text-anime-style-3 mb-3">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reprehenderit, corporis?</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo natus placeat nulla sint eaque, vel ad, doloremque consequatur esse dolores provident minima voluptatum enim amet.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad pariatur sunt nihil aliquid distinctio nemo aliquam, maxime similique enim adipisci iusto laudantium possimus autem est provident facilis sit corrupti recusandae cupiditate architecto consequuntur modi hic! Ea harum ex, rerum tenetur adipisci optio laboriosam rem itaque! Minus a alias cupiditate velit?</p>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ad mollitia exercitationem quos minus voluptas magnam ratione minima perspiciatis voluptates enim!</p>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consectetur quisquam nulla veniam odio, sed consequatur corporis dolore soluta illo inventore quia fugit, nisi vel culpa nobis! Mollitia nemo in excepturi.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga dicta aspernatur pariatur recusandae nihil. Nostrum corporis molestiae perspiciatis eligendi a incidunt adipisci magni. Non eius deserunt placeat rerum omnis, ut in, blanditiis ad officiis voluptatum dicta similique. Quod quasi debitis, doloribus repudiandae eligendi, alias quam et soluta corporis vitae magni.</p>
                <h2 class="text-anime-style-3 mb-3">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reprehenderit, corporis?</h2>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consectetur quisquam nulla veniam odio, sed consequatur corporis dolore soluta illo inventore quia fugit, nisi vel culpa nobis! Mollitia nemo in excepturi.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga dicta aspernatur pariatur recusandae nihil. Nostrum corporis molestiae perspiciatis eligendi a incidunt adipisci magni. Non eius deserunt placeat rerum omnis, ut in, blanditiis ad officiis voluptatum dicta similique. Quod quasi debitis, doloribus repudiandae eligendi, alias quam et soluta corporis vitae magni.</p>
                <h2 class="text-anime-style-3 mb-3">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reprehenderit, corporis?</h2>
                <ul>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit, quaerat!</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit, quaerat!</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit, quaerat!</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit, quaerat!</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit, quaerat!</li>
                </ul>
                
            </div> --}}
        </div>

        
    
    </div>



    @include ("Front.includes.footer")

</body>

</html>