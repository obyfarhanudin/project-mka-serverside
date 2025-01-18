document.getElementById('postPengajuan').addEventListener('submit', function (e) {
    e.preventDefault(); 


  
    document.querySelector('.loading').style.display = 'block';
    document.querySelector('.error-message').style.display = 'none';
    document.querySelector('.sent-message').style.display = 'none';

  
    setTimeout(() => {
       
        document.querySelector('.loading').style.display = 'none';
        document.querySelector('.sent-message').style.display = 'block';
        
        console.log('Data yang akan dikirim:', data.toString());
        
       
        document.getElementById('postPengajuan').reset(); 
    }, 2000); 
});
