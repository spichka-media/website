import {TextControl, PanelBody, PanelRow, Button} from '@wordpress/components';
import {useBlockProps, InspectorControls} from '@wordpress/block-editor';

export default function edit({attributes, setAttributes}) {
  const blockProps = useBlockProps();

  const {slides = []} = attributes;

  const updateSlide = (index, key, value) => {
    const updatedSlides = [...slides];
    updatedSlides[index] = {...updatedSlides[index], [key]: value};
    setAttributes({slides: updatedSlides});
  };

  const addSlide = () => {
    setAttributes({
      slides: [...slides, {attachment_id: '', caption: ''}],
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
                <TextControl
                  label={`Подпись ${index + 1}`}
                  value={slide.caption}
                  onChange={(value) => updateSlide(index, 'caption', value)}
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
