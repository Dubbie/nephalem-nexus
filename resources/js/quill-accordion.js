import Quill from "quill";

let BlockEmbed = Quill.import('blots/block/embed');
const icons = Quill.import('ui/icons');
icons['accordion'] = `
  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-selector"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 9l4 -4l4 4" /><path d="M16 15l-4 4l-4 -4" /></svg>
`; // Simple up-down arrow for accordion

class AccordionBlot extends BlockEmbed {
  static create(value) {
    let node = super.create();
    node.setAttribute('data-accordion', true);

    const title = document.createElement('h3');
    title.classList.add('accordion-title');
    title.innerText = value.title || "Accordion Title";

    const content = document.createElement('div');
    content.classList.add('accordion-content');
    content.innerText = value.content || "Accordion Content";

    node.appendChild(title);
    node.appendChild(content);

    return node;
  }

  static value(node) {
    return {
      title: node.querySelector('.accordion-title').innerText,
      content: node.querySelector('.accordion-content').innerText
    };
  }
}

AccordionBlot.blotName = 'accordion';
AccordionBlot.tagName = 'div';
AccordionBlot.className = 'accordion';

Quill.register(AccordionBlot);
