if((/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))){
    window.onscroll = () => {
        const navM = document.querySelector('#navbar');
        if(this.scrollY <= 200){
            navM.className = 'navbar';
        }
        else{
            navM.className = 'navbar-scroll-mob';
        }
    };
} 
