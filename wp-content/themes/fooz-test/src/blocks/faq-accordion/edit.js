import {InnerBlocks, useBlockProps, RichText} from '@wordpress/block-editor';
import {__} from "@wordpress/i18n";

export default function Edit({attributes, setAttributes}) {
    const {title} = attributes;

    return (
        <div {...useBlockProps({className: 'c-faq'})}>
            <RichText
                tagName="h2"
                className="c-faq__main-title"
                value={title}
                onChange={(newTitle) => setAttributes({title: newTitle})}
                placeholder={__('Add FAQ title', 'fooz-test')}
            />

            <div className="c-faq__items">
                <InnerBlocks
                    allowedBlocks={['fooz-test/faq-item']}
                    template={[
                        ['fooz-test/faq-item']
                    ]}
                    renderAppender={ InnerBlocks.ButtonBlockAppender }
                    templateLock={false}
                />
            </div>
        </div>
    );
}