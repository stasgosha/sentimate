$(function () {
$('body').on('change', '.select-field select', function () {
    loadfilter(-1);
});

 function loadfilter(remove){
    var active = $('#taxactive').val();
    var industry;
    var material;
    var production_method;

    $('.cmp-filters select').each(function () {

        if ($(this).attr('data-tax') == 'industry') {
            industry =parseInt($(this).val());
            if(remove==industry){
                industry=0;
            }
            if(industry){
                $('.applied-tags-list .industry').removeClass('hidden');
                $('.applied-tags-list .industry .item-text').text($(this).find('option:selected').text());
                $('.applied-tags-list .industry button').attr('data-id',$(this).val());
            }else{
                 $('.applied-tags-list .industry').addClass('hidden');
            }
        }

        if ($(this).attr('data-tax') == 'material') {
            material =  parseInt($(this).val());
            if(remove==material){
                material=0;
            }
            if(material){
                $('.applied-tags-list .material').removeClass('hidden');
                $('.applied-tags-list .material .item-text').text($(this).find('option:selected').text());
                 $('.applied-tags-list .material button').attr('data-id',$(this).val());
            }else{
                 $('.applied-tags-list .material').addClass('hidden');
            }
        }
        if ($(this).attr('data-tax') == 'production_method') {
            production_method =  parseInt($(this).val());
            if(remove==production_method){
                production_method=0;
            }
            if(production_method){
                $('.applied-tags-list .production_method').removeClass('hidden');
                $('.applied-tags-list .production_method .item-text').text($(this).find('option:selected').text());
                 $('.applied-tags-list .production_method button').attr('data-id',$(this).val());
            }else{
                 $('.applied-tags-list .production_method').addClass('hidden');
            }
        }

        if(production_method || material || industry){
            $('.nofilters').addClass('hidden');
        }else{
            $('.nofilters').removeClass('hidden');
        }



    });
    var data = {
        'action': 'load_filter',
        'industry': industry,
        'material': material,
        'production_method': production_method,
        'active': active,

    };
    $.ajax({
        url: ajaxurl,
        data: data,
        type: 'POST',
        beforeSend: function (xhr) {
            $('body').addClass('loading');
        },
        success: function (data) {
            if (data) {
                $('.products-filter').html(data);
	            jcf.replace( $('.select-field select') );
            }
        },
    });
        var link=$('#taxactivelink').val()+'?filter=true';
         if(industry){
           link=link+'&industry_='+industry;
        }
         if(material){
           link=link+'&material_='+material;
        }
        if(production_method){
           link=link+'&production_method='+production_method;
        }
        $('#loadwrap').load(link+' #loadrezult');





}


    $('#searchinput').keyup(function(){
        var val=$(this).val();
        $('.cmp-suggestions').removeClass('visible');
        if(val.length>3){
            var data = {
                'action': 'loadsearch',
                'val': val,

            };
            $.ajax({
                url: ajaxurl,
                data: data,
                type: 'POST',
                beforeSend: function (xhr) {
                    $('body').addClass('loading');
                },
                success: function (data) {
                    if (data) {
                        $('.cmp-suggestions').addClass('visible');
                        $('#search_rezult').html(data);
                    }
                },
            });
        }

    });


    $('.categoryes input').change(function(){
        loadcatalog();
    });
    $('.brands_wrap input').change(function(){
        loadcatalog();
    });

    function loadcatalog(){
        var url=$('#link').val();
        console.log($('.brands_wrap input').val());
        var brands='';
        var category='';
        $('.brands_wrap input').each(function(){
            if ($(this).is(':checked')) {
                if(brands) {
                    brands = brands + ',' + $(this).val();
                }else{
                    brands =$(this).val();
                }
            }
        });
        $('.categoryes input').each(function(){
            if ($(this).is(':checked')) {
                if(category) {
                    category = category + ',' + $(this).val();
                }else{
                    category =$(this).val();
                }
            }
        });
        url=url+'?categoryes='+category+'&brands='+brands;

        $('#wrapload').load(url+' #wrapinclude');
    }
 $('#brands_search').on("keyup keydown",function(){
        var val=$(this).val().toLowerCase();

        $('.brands_wrap').removeClass('hidden');
        $('.brands_wrap label').removeClass('hidden');
         if(val) {
             var first = val[0].toLowerCase();
         }
        if(first) {
            $('.brands_wrap .list-caption').each(function(){
                if ($(this).text().toLowerCase() != first) {
                    $(this).parent().addClass('hidden');
                }else{
                    $(this).parent().find('label').each(function(){
                        var str=$(this).text().toLowerCase();

                        if(-1 === str.indexOf(val)) {
                            console.log(str);
                            console.log(str.indexOf(val));
                            $(this).addClass('hidden');
                        }
                    })
                }
            });

        }

    });
$('.applied-tags-list .remove-btn').click(function(){
     loadfilter($(this).attr('data-id'));
});
});


































