$(document).ready(function () {
    // Manejar clic en tarjetas de servicios
    $('.tarjeta_servicio').click(function () {
      const divId = this.id;
  
      switch (divId) {
        case 'psicologo':
          window.location.href = 'psicologos.php';
          break;
        case 'workshops':
          window.location.href = 'workshops.php';
          break;
        case 'articulos':
          window.location.href = 'articulos.php';
          break;
        case 'libros':
          window.location.href = 'libros.php';
          break;
        default:
          // Manejar cualquier otro caso si es necesario
          break;
      }
    });
  
    // Animación de porcentajes al desplazarse
    const elementosPorcentaje = $(".circulo .inner #number");
    const section5Element = $(".section_5");
  
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            iniciarAnimacionesPorcentaje();
            observer.unobserve(section5Element[0]);
          }
        });
      },
      { threshold: 0.5 }
    );
  
    observer.observe(section5Element[0]);
  
    function iniciarAnimacionesPorcentaje() {
      elementosPorcentaje.each(function () {
        const porcentajeFinal = parseInt($(this).text(), 10);
        const duracion = 2000; // Duración de la animación en milisegundos
        const incremento = porcentajeFinal / (duracion / 16.7); // Aproximadamente 60 FPS
        let porcentajeActual = 0;
  
        const actualizarPorcentaje = () => {
          if (porcentajeActual < porcentajeFinal) {
            porcentajeActual += incremento;
            $(this).text(Math.ceil(porcentajeActual) + "%");
            setTimeout(actualizarPorcentaje, 16.7);
          } else {
            $(this).text(porcentajeFinal + "%");
          }
        };
  
        actualizarPorcentaje();
      });
    }
  });
  