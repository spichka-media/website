import {
  TextControl,
  PanelBody,
  PanelRow,
  Button,
  TextareaControl,
} from '@wordpress/components';
import {useBlockProps, InspectorControls} from '@wordpress/block-editor';

export default function edit({attributes, setAttributes}) {
  const blockProps = useBlockProps();

  const {slides = [], caption = ''} = attributes;

  const updateSlide = (index, key, value) => {
    const updatedSlides = [...slides];
    updatedSlides[index] = {...updatedSlides[index], [key]: value};
    setAttributes({slides: updatedSlides});
  };

  const addSlide = () => {
    setAttributes({
      slides: [...slides, {attachment_id: ''}],
    });
  };

  const removeSlide = (index) => {
    const updatedSlides = slides.filter((_, i) => i !== index);
    setAttributes({slides: updatedSlides});
  };

  return (
    <div {...blockProps}>
      <InspectorControls>
        <PanelBody title="Настройки" initialOpen={true}>
          <PanelRow>
            <TextareaControl
              label="Подпись"
              value={caption}
              onChange={(value) => setAttributes({caption: value})}
              help="Добавьте общий текст для всех слайдов."
            />
          </PanelRow>
          {slides.map((slide, index) => (
            <PanelRow key={index}>
              <fieldset>
                <TextControl
                  label={`ID картинки в медиагалерее ${index + 1}`}
                  value={slide.attachment_id}
                  onChange={(value) =>
                    updateSlide(index, 'attachment_id', value)
                  }
                />
                <Button
                  variant="secondary"
                  isDestructive
                  onClick={() => removeSlide(index)}>
                  Удалить слайд
                </Button>
              </fieldset>
            </PanelRow>
          ))}
          <PanelRow>
            <Button variant="primary" onClick={addSlide}>
              Добавить слайд
            </Button>
          </PanelRow>
        </PanelBody>
      </InspectorControls>
      <p>Я слайдер, смотри настройки</p>
    </div>
  );
}
