if(!(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))){
    window.onscroll = () => {
        const nav = document.querySelector('#navbar');
        if(this.scrollY <= 400){
            nav.className = 'navbar';
          if (typeof cta !== 'undefined'){
            cta.className = 'cta';
            }
        }
        else{
            nav.className = 'navbar-scroll';
        }
    };
} 
