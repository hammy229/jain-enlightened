@include ("Front.includes.header")

<style>
    .research-section .educational-resources .product_card{
        background-color: #fff;
        margin-bottom: 30px;
    }
    .research-section .academics-resources .product_card, .books-and-publications .product_card{
        background-color: #f7f7f7;
        margin-bottom: 30px;
    }
    .books-and-publications .res-read-more i{
        opacity: 1 !important;
        padding-left: 5px !important;
    }
    .books-and-publications span.btn-default {
        font-size: 14px;
        line-height: 0;
        padding: 10px 20px;
        margin-top: 12px;
    }
    .books-and-publications span.btn-default i {
        margin-left: 5px;
    }
    .books-and-publications .product_card:hover span.btn-default::before{
        width: 106%;
        opacity: 1;
    }
</style>

    <!-- Page header Start -->
    <div class="page-header parallaxie" style="background-image: url('front/images/page-banners/podcasts.jpg')">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- Page Header box Start -->
                    <div class="page-header-box">
                        <h2 class="text-anime-style-3">Research</h2>                              
                        <nav class="wow fadeInUp" data-wow-delay="0.25s">
                            <ol class="breadcrumb">
                                <li><a href="{{URL::asset('/')}}">Home</a></li>
                                <li> Research</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="research-section">
        <div class="resources-section books-and-publications" style="background-color: #fff">
            <div class="container">
                <div class="row">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h2 class="text-anime-style-3">Books / <span> Publishing</span></h2>
                        <!-- <p class="wow fadeInUp" data-wow-delay="0.25s">Discover the principles of Jainism and apply them to your daily life through our comprehensive lessons.</p> -->
                    </div>
                    <!-- Section Title End -->
                    <div class="col-md-4">
                        <div class="product_card">
                            <a href="javascript:void(0);">
                                <figure class="image-anime">
                                    <img src="{{URL::asset('front/images/logo/logo.png')}}" alt="">
                                </figure>
                                <div class="product_info">
                                    <h2 class="product_name">
                                        Lorem ipsum dolor sit amet.
                                    </h2>
                                    <p class="product_description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem maiores voluptate illo fugiat officiis velit omnis, impedit mollitia! Praesentium, culpa voluptatibus quaerat autem molestiae laborum voluptate est temporibus! Recusandae, ab.</p>
                                    <span class="btn-default">Download PDF
                                        <i class="fa fa-download"></i>
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="product_card">
                            <a href="javascript:void(0);">
                                <figure class="image-anime">
                                    <img src="{{URL::asset('front/images/logo/logo.png')}}" alt="">
                                </figure>
                                <div class="product_info">
                                    <h2 class="product_name">
                                        Lorem ipsum dolor sit amet.
                                    </h2>
                                    <p class="product_description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Modi maiores voluptatum praesentium explicabo velit enim quo veniam inventore ea quasi tenetur nihil, et magnam similique qui, minima obcaecati commodi quam!</p>
                                    <span class="btn-default">Download PDF
                                        <i class="fa fa-download"></i>
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="product_card">
                            <a href="javascript:void(0);">
                                <figure class="image-anime">
                                    <img src="{{URL::asset('front/images/logo/logo.png')}}" alt="">
                                </figure>
                                <div class="product_info">
                                    <h2 class="product_name">
                                        Lorem ipsum dolor sit amet.
                                    </h2>
                                    <p class="product_description">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quam sequi, reiciendis impedit provident deleniti similique error saepe hic corrupti nulla temporibus debitis, ratione ad quaerat ea quae fugiat. Voluptas, cum.</p>
                                    <span class="btn-default">Download PDF
                                        <i class="fa fa-download"></i>
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="product_card">
                            <a href="javascript:void(0);">
                                <figure class="image-anime">
                                    <img src="{{URL::asset('front/images/logo/logo.png')}}" alt="">
                                </figure>
                                <div class="product_info">
                                    <h2 class="product_name">
                                        Lorem ipsum dolor sit amet.
                                    </h2>
                                    <p class="product_description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem maiores voluptate illo fugiat officiis velit omnis, impedit mollitia! Praesentium, culpa voluptatibus quaerat autem molestiae laborum voluptate est temporibus! Recusandae, ab.</p>
                                    <span class="btn-default">Download PDF
                                        <i class="fa fa-download"></i>
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="product_card">
                            <a href="javascript:void(0);">
                                <figure class="image-anime">
                                    <img src="{{URL::asset('front/images/logo/logo.png')}}" alt="">
                                </figure>
                                <div class="product_info">
                                    <h2 class="product_name">
                                        Lorem ipsum dolor sit amet.
                                    </h2>
                                    <p class="product_description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Modi maiores voluptatum praesentium explicabo velit enim quo veniam inventore ea quasi tenetur nihil, et magnam similique qui, minima obcaecati commodi quam!</p>
                                    <span class="btn-default">Download PDF
                                        <i class="fa fa-download"></i>
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="product_card">
                            <a href="javascript:void(0);">
                                <figure class="image-anime">
                                    <img src="{{URL::asset('front/images/logo/logo.png')}}" alt="">
                                </figure>
                                <div class="product_info">
                                    <h2 class="product_name">
                                        Lorem ipsum dolor sit amet.
                                    </h2>
                                    <p class="product_description">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quam sequi, reiciendis impedit provident deleniti similique error saepe hic corrupti nulla temporibus debitis, ratione ad quaerat ea quae fugiat. Voluptas, cum.</p>
                                    <span class="btn-default">Download PDF
                                        <i class="fa fa-download"></i>
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Post Pagination Start -->
                        <div class="post-pagination wow fadeInUp" data-wow-delay="1s">
                            <ul class="pagination">
                                <li><a href="#"><i class="fa-solid fa-arrow-left-long"></i></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#"><i class="fa-solid fa-arrow-right-long"></i></a></li>
                            </ul>
                        </div>
                        <!-- Post Pagination End -->
                    </div>
                </div>
            </div>
        </div>

        <div class="resources-section educational-resources" style="background-color: #f7f7f7">
            <div class="container">
                <div class="row">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h2 class="text-anime-style-3">Jainism Additional <span> Educational Resources</span></h2>
                        <!-- <p class="wow fadeInUp" data-wow-delay="0.25s">Discover the principles of Jainism and apply them to your daily life through our comprehensive lessons.</p> -->
                    </div>
                    <!-- Section Title End -->
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="product_card">
                            <a href="javascript:void(0);">
                                <figure class="image-anime">
                                    <img src="{{URL::asset('front/images/logo/logo.png')}}" alt="">
                                </figure>
                                <div class="product_info">
                                    <h2 class="product_name">
                                        Lorem ipsum dolor sit amet.
                                    </h2>
                                    <p class="product_description">A comprehensive digital library offering a vast collection of Jain scriptures, manuscripts, and research papers. It is an essential resource for those looking to deepen their understanding of Jain philosophy, history, and practices. </p>
                                    <span class="res-read-more">Read More
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="product_card">
                            <a href="javascript:void(0);">
                                <figure class="image-anime">
                                    <img src="{{URL::asset('front/images/logo/logo.png')}}" alt="">
                                </figure>
                                <div class="product_info">
                                    <h2 class="product_name">
                                        Lorem ipsum dolor sit amet.
                                    </h2>
                                    <p class="product_description">JAINA provides extensive resources on Jainism, including educational materials, event information, and community outreach programs. It is a hub for Jains in North America and beyond, promoting the teachings and values of Jainism.</p>
                                    <span class="res-read-more">Read More
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="product_card">
                            <a href="javascript:void(0);">
                                <figure class="image-anime">
                                    <img src="{{URL::asset('front/images/logo/logo.png')}}" alt="">
                                </figure>
                                <div class="product_info">
                                    <h2 class="product_name">
                                        Lorem ipsum dolor sit amet.
                                    </h2>
                                    <p class="product_description">A global online platform dedicated to promoting Jainism and its teachings. The site features articles, interviews, and research on various aspects of Jain philosophy and lifestyle, making it a valuable resource for scholars and practitioners alike. Jain World</p>
                                    <span class="res-read-more">Read More
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="product_card">
                            <a href="javascript:void(0);">
                                <figure class="image-anime">
                                    <img src="{{URL::asset('front/images/logo/logo.png')}}" alt="">
                                </figure>
                                <div class="product_info">
                                    <h2 class="product_name">
                                        Lorem ipsum dolor sit amet.
                                    </h2>
                                    <p class="product_description">Jain World offers an extensive range of resources, including scriptures, rituals, history, and cultural practices. It also provides tools for learning about Jainism, including e-books and audio-visual materials.</p>
                                    <span class="res-read-more">Read More
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Post Pagination Start -->
                        <div class="post-pagination wow fadeInUp" data-wow-delay="1s">
                            <ul class="pagination">
                                <li><a href="#"><i class="fa-solid fa-arrow-left-long"></i></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#"><i class="fa-solid fa-arrow-right-long"></i></a></li>
                            </ul>
                        </div>
                        <!-- Post Pagination End -->
                    </div>
                </div>
            </div>
        </div>

        <div class="resources-section academics-resources" style="background-color: #fff">
            <div class="container">
                <div class="row">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h2 class="text-anime-style-3">Jainism Research and <span> Academic Resources</span></h2>
                        <!-- <p class="wow fadeInUp" data-wow-delay="0.25s">Discover the principles of Jainism and apply them to your daily life through our comprehensive lessons.</p> -->
                    </div>
                    <!-- Section Title End -->
                    <div class="col-md-4">
                        <div class="product_card">
                            <a href="javascript:void(0);">
                                <figure class="image-anime">
                                    <img src="{{URL::asset('front/images/logo/logo.png')}}" alt="">
                                </figure>
                                <div class="product_info">
                                    <h2 class="product_name">
                                        Arham Doshi (Founder) Research Paper
                                    </h2>
                                    <p class="product_description">Loss on AI Translation</p>
                                    <span class="res-read-more">Read More
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="product_card">
                            <a href="javascript:void(0);">
                                <figure class="image-anime">
                                    <img src="{{URL::asset('front/images/logo/logo.png')}}" alt="">
                                </figure>
                                <div class="product_info">
                                    <h2 class="product_name">
                                        Lorem ipsum dolor sit amet.
                                    </h2>
                                    <p class="product_description">L. D. Institute of Indology: An institution dedicated to the research and study of Jainology and Indology. It houses a vast collection of rare manuscripts, books, and research publications, making it a critical resource for scholars interested in Jain studies.</p>
                                    <span class="res-read-more">Read More
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="product_card">
                            <a href="javascript:void(0);">
                                <figure class="image-anime">
                                    <img src="{{URL::asset('front/images/logo/logo.png')}}" alt="">
                                </figure>
                                <div class="product_info">
                                    <h2 class="product_name">
                                        Lorem ipsum dolor sit amet.
                                    </h2>
                                    <p class="product_description">Prakrit Bharati Academy: This academy focuses on the study and promotion of Prakrit languages, Jain literature, and Indian culture. The website offers access to research publications, educational programs, and scholarly articles.</p>
                                    <span class="res-read-more">Read More
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="product_card">
                            <a href="javascript:void(0);">
                                <figure class="image-anime">
                                    <img src="{{URL::asset('front/images/logo/logo.png')}}" alt="">
                                </figure>
                                <div class="product_info">
                                    <h2 class="product_name">
                                        Lorem ipsum dolor sit amet.
                                    </h2>
                                    <p class="product_description">Young Jains of America (YJA): YJA is a platform for young Jains to engage with their faith and culture. It provides resources for education, community service, and leadership development, fostering a deeper connection to Jain values among youth.</p>
                                    <span class="res-read-more">Read More
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="product_card">
                            <a href="javascript:void(0);">
                                <figure class="image-anime">
                                    <img src="{{URL::asset('front/images/logo/logo.png')}}" alt="">
                                </figure>
                                <div class="product_info">
                                    <h2 class="product_name">
                                        Lorem ipsum dolor sit amet.
                                    </h2>
                                    <p class="product_description">Jain Vishwa Bharati is a spiritual, educational, and cultural center that promotes the teachings of Jainism through various programs and publications. The site offers resources for learning and practicing Jain values in daily life.</p>
                                    <span class="res-read-more">Read More
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="product_card">
                            <a href="javascript:void(0);">
                                <figure class="image-anime">
                                    <img src="{{URL::asset('front/images/logo/logo.png')}}" alt="">
                                </figure>
                                <div class="product_info">
                                    <h2 class="product_name">
                                        Lorem ipsum dolor sit amet.
                                    </h2>
                                    <p class="product_description">ISJS offers a platform for advanced study and research in Jainism. The site provides access to academic courses, research papers, and publications that explore Jain philosophy, ethics, and history in-depth.</p>
                                    <span class="res-read-more">Read More
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Post Pagination Start -->
                        <div class="post-pagination wow fadeInUp" data-wow-delay="1s">
                            <ul class="pagination">
                                <li><a href="#"><i class="fa-solid fa-arrow-left-long"></i></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#"><i class="fa-solid fa-arrow-right-long"></i></a></li>
                            </ul>
                        </div>
                        <!-- Post Pagination End -->
                    </div>
                </div>
            </div>
        </div>
    </div>



    @include ("Front.includes.footer")

    <script>
        $(".research_active").addClass("active");
    </script>
</body>

</html>