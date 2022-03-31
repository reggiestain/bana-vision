<template>
	<div>
        <div class="container-fluid col-12 p-0 mt-4">
        <img src="/assets/img/map.svg" alt="Kiwi standing on oval" >
    
    </div>
		 <div class="row m-0 p-0 pr-3 pl-3 mt-2">
                <!--================================================BOOKS================================================-->
                <div class="card col-12 col-md-3 d-inline-flex  mb-3 p-0 home-card" >
                    <div class="card-header" style="background: rgb(44,40,119);background: linear-gradient(187deg, rgba(44,40,119,1) 0%, rgba(29,101,177,0.8827906162464986) 42%, rgba(0,212,255,1) 100%);">
                        <i class="fas fa-1x fa-book" style="color: #ffffff"></i>
                        <span class="ml-1" style="color:white">
                            <strong>
                            Books
                        </strong>
                        </span>
                    </div>
                    <div class="card-body " style="max-height:40vh">
                        <!-- <h5 class="card-title">Primary card title</h5> -->
                        <ul class="fa-ul" style="display: list">
                            <li class="card-text pb-3  feature-unavailable" >
                                <i class="fa-li fa fa-chevron-right" style="color:rgb(35, 154, 212)"></i>
                            Book of the month
                            </li>
                            <li class="card-text  pb-3 feature-unavailable">
                                <i class="fa-li fa fa-chevron-right" style="color:rgb(35, 154, 212)"></i>
                            Latest Reviews
                            </li>
                            <li class="card-text   pb-3 feature-unavailable">
                                <i class="fa-li fa fa-chevron-right" style="color:rgb(35, 154, 212)"></i>
                            Most Read
                            </li>
                            <li class="card-text  pb-3 feature-unavailable">
                            	<i class="fa-li fa fa-chevron-right" style="color:rgb(35, 154, 212)"></i>
                            Suggested
                            </li>
                        </ul>
                    </div>
                </div>

                <!--================================================RANKINGS================================================-->
                <div class="card col-12 col-md-3 d-inline-flex   mb-3 p-0 home-card home-card-other" >
                    <div class="card-header primary" style="background: rgb(44,40,119);background: linear-gradient(187deg, rgba(44,40,119,1) 0%, rgba(29,101,177,0.8827906162464986) 42%, rgba(0,212,255,1) 100%);">
                        <i class="fas fa-1x fa-sort-numeric-up text-light" ></i>
                        <span class="ml-1 text-light">
                            <strong>
                            Rankings
                        </strong>
                        </span>
                    </div>
                    <div class="card-body" style="max-height:40vh">
                        <ul class="fa-ul" style="display: list">
                            <li class="card-text  pb-3 feature-unavailable" >
                                <i class="fa-li fa fa-chevron-right" style="color:rgb(35, 154, 212)"></i>
                                Sports
                            </li>
                            <li class="card-text  pb-3 feature-unavailable" >
                                <i class="fa-li fa fa-chevron-right" style="color:rgb(35, 154, 212)"></i>
                                Academics
                            </li>
                            <li class="card-text pb-3 feature-unavailable" >
                                <i class="fa-li fa fa-chevron-right" style="color:rgb(35, 154, 212)"></i>
                            Extra Mural Activities
                            </li>
                        </ul>
                    </div>
                </div>

                <!--================================================ANNOUNCEMENTS================================================-->
                <div class="card col-12 col-md-3 d-inline-flex  mb-3 p-0 home-card home-card-other" >
                    <div class="card-header" style="background: rgb(44,40,119);background: linear-gradient(187deg, rgba(44,40,119,1) 0%, rgba(29,101,177,0.8827906162464986) 42%, rgba(0,212,255,1) 100%);"><i class="fas fa-1x fa-bullhorn text-light"></i>
                        <span class="ml-1 text-light">
                            <strong>
                            Announcements
                        </strong>
                    </span>
                </div>
                    <div class="card-body" style="max-height:40vh">
                    	<div  v-for="announcement in announcements">
                        <ul  class="fa-ul" style="display: list;">
                            <li class="card-text " >
                                <a :href="announcement_href(announcement.id)" class="text-dark">
                                <i class="fa-li fa fa-chevron-right" style="color:rgb(35, 154, 212)"></i>
                                {{announcement.announcement.substr(0, 80)+' ....'}}
                            </a>
                            </li>
                        </ul>
                    </div>
                    </div>
                </div>

                 <!--================================================BANA NEWS================================================-->
                <div class="card col-12 col-md-3 d-inline-flex  mb-3 p-0 home-card home-card-other" >
                    <div class="card-header" style="background: rgb(44,40,119);background: linear-gradient(187deg, rgba(44,40,119,1) 0%, rgba(29,101,177,0.8827906162464986) 42%, rgba(0,212,255,1) 100%);">
                        <i class="fas fa-1x fa-rss-square text-light"></i>
                        <span class="ml-1 text-light">
                            <strong>
                            Bana News
                        </strong>
                    </span>
                </div>
                    <div class="card-body" style="max-height:40vh">
                    	<div  v-for="news_ in news">
                        <ul  class="fa-ul" style="display: list;">
                            <li class="card-text " >
                                <a :href="news_href(news_.id)" class="text-dark">
                                <i class="fa-li fa fa-chevron-right" style="color:rgb(35, 154, 212)"></i>
                                {{news_.article.substr(0, 80)+' ....'}}
                            </a>
                            </li>
                        </ul>
                    </div>
                    </div>
                </div>
            </div>
	</div>
</template>
<script>
	export default
	{
		props:['announcements','news'],
         metaInfo() {
        return { 
            title: "Bana run with your vision",
            meta: [
                { name: 'description', content:  'Our mission is to have people, locally as well as from across the globe, interact more easily within the education space, whether it be through ideas, tools or aid. We believe that the closer online and offline communication behaviors and standards align, the more effectively you can mobilize energy between worlds, specifically the education world.'},
                { property: 'og:description', content: "Our mission is to have people, locally as well as from across the globe, interact more easily within the education space, whether it be through ideas, tools or aid. We believe that the closer online and offline communication behaviors and standards align, the more effectively you can mobilize energy between worlds, specifically the education world."},
                { property: 'og:title', content: "Bana is an educational social media platform"},
                { property: 'og:site_name', content: 'BANA'},
                {property:'og:url' , content:'https://bana.vision'},
                {property: 'og:image', content: 'https://bana.vision/assets/img/bana_hires.png'},
                {property: 'og:type', content: 'website'},  
                {name:'keywords', content:'edtech, bana, education,platform,kage,tshepo,afrotech,online,marketplace'},  
                {name: 'robots', content: 'index,follow'} 
            ]
        }
    },
        methods:{
            announcement_href:function(id)
            {
                return '/info-center/announcements/#announcement'+id;
            },
            news_href:function(id)
            {
                return '/info-center/news/#news'+id;
            },
        }
	}
</script>