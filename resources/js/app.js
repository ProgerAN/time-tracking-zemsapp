import './bootstrap';
import 'flowbite';

// Если /livewire/livewire.js выдает 404
// и вы работаете с nginx, -> https://benjamincrozat.com/livewire-js-404-not-found#using-nginx
// и вы работаете с apache, то закомментируйте код ниже:
import { Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm'
Livewire.start()
