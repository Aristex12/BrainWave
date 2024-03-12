$(document).ready(function () {
    const elementosContador = $(".contador");
    const section4Element = $("#triggerSection4");
  
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            iniciarAnimaciones();
            observer.unobserve(section4Element[0]);
          }
        });
      },
      { threshold: 0.5 }
    );
  
    observer.observe(section4Element[0]);
  
    function iniciarAnimaciones() {
      elementosContador.each(function () {
        const valorFinal = parseInt($(this).attr("data-valor"), 10);
        const duracion = 2000; // Duración de la animación en milisegundos
        const incremento = valorFinal / (duracion / 16.7); // Aproximadamente 60 FPS
        let valorActual = 0;
  
        const actualizarContador = () => {
          if (valorActual < valorFinal) {
            valorActual += incremento;
            $(this).text(Math.ceil(valorActual));
            setTimeout(actualizarContador, 16.7);
          } else {
            $(this).text(valorFinal);
          }
        };
  
        actualizarContador();
      });
    }
  });
  