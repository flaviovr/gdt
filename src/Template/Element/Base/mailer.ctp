<style>
   section#mailer {/* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#febf01+0,febf01+100;Yellow+Flat */
background: #febf01; /* Old browsers */
background: -moz-linear-gradient(top,  #febf01 0%, #febf01 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(top,  #febf01 0%,#febf01 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to bottom,  #febf01 0%,#febf01 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#febf01', endColorstr='#febf01',GradientType=0 ); /* IE6-9 */
; padding: 30px 30px; margin:0px; }
   section#mailer .title {font-size:36px; font-weight:700; color: var(--shade3); line-height:15px;}
   section#mailer .title .small { font-size:16px; color: var(--shade3);font-weight:400; line-height:20px; text-transform:uppercase; }
    
</style>
<section id='mailer' class='padrao'>

    <div class="row">

        <div class="title col-12 col-md-5 text-center">
            <span class='title'><i class="fas fa-at"></i>NEWSLETTER <br></span>
            <span class='small'>Cadastre seu email e receba novidades</span>
        </div>
        <div class="col-12 col-md-7 ">
            <?= $this->Form->create(null,['id'=>'news_form']);?>
            <div class="input-group " style='margin-top:10px;'>
                <?= $this->Form->contro('email',['class'=>'form-control','placeholder'=>'Digite seu nome', 'name'=>'news_email','id'=>'news_email'])?>
                <div class="input-group-append">
                <button class="btn btn-success" type="submit" id="news_add">Cadastrar</button>
                </div>
            </div>
            <?= $this->Form->end();?>
        </div>  
    </div>
</section>

