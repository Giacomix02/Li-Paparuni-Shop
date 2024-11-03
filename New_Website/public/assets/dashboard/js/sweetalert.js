
document.addEventListener("DOMContentLoaded", async () => {


    let span = document.getElementById('alert')
    if(span.innerText === "edited"){
        await Swal.fire({
            icon: "success",
            text: "Modifica effettuata con successo!",
            showConfirmButton: false,
            timer: 1600
        })

        // Rimuove '/edited' dall'URL e reindirizza
        let url = window.location.href.replace('/edited', '');
        window.location.href = url;

    } else if(span.innerText === "error"){
        await Swal.fire({
            icon: "error",
            text: "Errore durante l'Operazione!",
            showConfirmButton: false,
            timer: 1600
        })
        // Rimuove '/edited' dall'URL e reindirizza
        let url = window.location.href.replace('/error', '');
        window.location.href = url;
    } else if(span.innerText === "added"){
        await Swal.fire({
            icon: "success",
            text: "Aggiunta effettuata con successo!",
            showConfirmButton: false,
            timer: 1600
        })
        // Rimuove '/edited' dall'URL e reindirizza
        let url = window.location.href.replace('/added', '');
        window.location.href = url;
    }else if(span.innerText === "deleted"){
        await Swal.fire({
            icon: "success",
            text: "Eliminazione effettuata con successo!",
            showConfirmButton: false,
            timer: 1600
        })
        // Rimuove '/edited' dall'URL e reindirizza
        let url = window.location.href.replace('/deleted', '');
        window.location.href = url;
    }else if(span.innerText === "bannerLimit"){
        await Swal.fire({
            icon: "error",
            text: "Raggiunto numero limite di banner da inserire!",
            showConfirmButton: false,
            timer: 1600
        })
        // Rimuove '/edited' dall'URL e reindirizza
        let url = window.location.href.replace('/bannerLimit', '');
        window.location.href = url;
    }

});
