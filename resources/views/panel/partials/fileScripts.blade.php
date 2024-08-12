<script>
    function showTempFile({
        target
    }, mainContent, container) {
        const file = target.files[0];
        const myContainer = target.closest('.' + mainContent).querySelector('.' + container);
        const removeButton = Object.assign(document.createElement('button'), {
            type: 'button',
            className: 'btn-delete'
        });
        removeButton.innerHTML = `<svg viewBox="0 0 24 24" style="fill: white; width: 20px; height: 20px;">
        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" style="stroke-width: 4px;"></path>
        </svg>`;
        removeButton.addEventListener('click', function(e) {
            const img = myContainer.querySelector('img');
            const video = myContainer.querySelector('video');
            if (img) {
                img.remove()
            }
            if (video) {
                video.remove()
            }
            removeButton.remove();
            target.value = '';
        });

        if (target.accept) {
            if (target.accept.includes('video')) {
                const video = myContainer.querySelector('video');
                if (file.type.includes('video')) {
                    if (video) {
                        video.remove()
                    }
                    const videoElement = document.createElement('video');
                    videoElement.src = URL.createObjectURL(file);
                    videoElement.loop = true;
                    videoElement.muted = true;
                    videoElement.autoplay = true;
                    myContainer.appendChild(videoElement);
                } else {
                    target.value = '';
                }
            } else if (target.accept.includes('image')) {
                const img = myContainer.querySelector('img');
                if (file.type.includes('image')) {
                    if (img) {
                        img.remove()
                    }
                    const imageElement = document.createElement('img');
                    imageElement.src = URL.createObjectURL(file);
                    myContainer.appendChild(imageElement);
                } else {
                    target.value = '';
                }


            }
            myContainer.appendChild(removeButton);
        }
    }

    function removeFile(e, container, url = false) {
        e.preventDefault();

        axios.delete(url)
            .then(response => {
                location.reload();
            })
            .catch(error => {
                // Tratar erros da requisição (opcional)
                console.error('Erro ao deletar a imagem:', error);
            });
    }

    function toggleFile({
        target
    }) {
        const inputFile = target.closest('.form-group').querySelector('input[type="file"]').click();
    }
</script>