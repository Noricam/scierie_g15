let slideIndex = 0;
let slides = [];
let points = [];
let texteDescriptif = null;
let timer = null;

document.addEventListener('DOMContentLoaded', async () => {
  try {
    const res = await fetch('data.xml', { cache: 'no-store' });
    if (!res.ok) throw new Error(`HTTP ${res.status} sur data.xml`);

    const xmlText = await res.text();
    const xml = new DOMParser().parseFromString(xmlText, 'application/xml');

    // si data.xml est invalide, le parser crée un <parsererror>
    if (xml.querySelector('parsererror')) {
      throw new Error('data.xml invalide (XML mal formé)');
    }

    recupXmlSlider(xml);
  } catch (e) {
    console.error('Slider: impossible de charger data.xml', e);
  }
});

function recupXmlSlider(xml) {
  const slider = document.getElementById('slider');
  if (!slider) return;

  const slideNodes = Array.from(xml.querySelectorAll('slide'));

  slideNodes.forEach((s) => {
    const imgSrc = (s.querySelector('image')?.textContent || '').trim();
    const desc = (s.querySelector('description')?.textContent || '').trim();

    const wrap = document.createElement('div');
    wrap.className = 'slide';

    const img = document.createElement('img');
    img.src = imgSrc;
    img.alt = '';
    img.loading = 'lazy';
    img.decoding = 'async';

    const p = document.createElement('p');
    p.className = 'texteDescriptif';
    p.textContent = desc;

    wrap.appendChild(img);
    wrap.appendChild(p);
    slider.appendChild(wrap);
  });

  ImagesInit();
  setTimer();
}

function decalage(idx) {
  decalageSlide(slideIndex + idx);
}

function decalageSlide(n) {
  if (!slides.length) return;

  let idx, courant, suivant;
  const decalageSlideAnimClass = { forcourant: '', forsuivant: '' };
  let slideTextAnimClass = '';

  if (n > slideIndex) {
    if (n >= slides.length) n = 0;
    decalageSlideAnimClass.forcourant = 'decalageGaucheSlideCourante';
    decalageSlideAnimClass.forsuivant = 'decalageGaucheSlideSuivante';
    slideTextAnimClass = 'decalageTexteHaut';
  } else if (n < slideIndex) {
    if (n < 0) n = slides.length - 1;
    decalageSlideAnimClass.forcourant = 'decalageDroiteSlideCourante';
    decalageSlideAnimClass.forsuivant = 'decalageDroiteSlideSuivante';
    slideTextAnimClass = 'decalageTexteBas';
  } else {
    return;
  }

  suivant = slides[n];
  courant = slides[slideIndex];

  for (idx = 0; idx < slides.length; idx++) {
    slides[idx].className = 'slide';
    slides[idx].style.opacity = 0;
    points[idx]?.classList.remove('active');
  }

  courant.classList.add(decalageSlideAnimClass.forcourant);
  suivant.classList.add(decalageSlideAnimClass.forsuivant);

  points[n]?.classList.add('active');
  slideIndex = n;

  if (texteDescriptif) {
    texteDescriptif.style.display = 'none';
    texteDescriptif.className = 'texteDescriptif ' + slideTextAnimClass;
    texteDescriptif.textContent =
      slides[n].querySelector('.texteDescriptif')?.textContent || '';
    texteDescriptif.style.display = 'block';
  }
}

function setTimer() {
  clearInterval(timer);
  timer = setInterval(() => decalage(1), 5900);
}

function ImagesInit() {
  slideIndex = 0;
  slides = Array.from(document.getElementsByClassName('slide'));

  if (!slides.length) return;

  slides[slideIndex].style.opacity = 1;

  texteDescriptif = document.querySelector('.Descriptif .texteDescriptif');
  if (texteDescriptif) {
    texteDescriptif.textContent =
      slides[slideIndex].querySelector('.texteDescriptif')?.textContent || '';
  }

  points = [];
  const carouselPoint = document.getElementById('carouselPoint');
  if (!carouselPoint) return;

  carouselPoint.innerHTML = '';

  slides.forEach((_, idx) => {
    const point = document.createElement('span');
    point.classList.add('points');
    point.addEventListener('click', () => decalageSlide(idx));
    carouselPoint.appendChild(point);
    points.push(point);
  });

  points[slideIndex]?.classList.add('active');
}
