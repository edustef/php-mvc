import Navbar from './components/Navbar.js';
import { html, render } from 'https://unpkg.com/htm/preact/index.mjs?module';

function App (props) {
  return html`
    <${Navbar}/>
    <main class="mt-4 container">
    </main>
  `;
}

render(html`<${App} name="World" />`, document.getElementById('root'));