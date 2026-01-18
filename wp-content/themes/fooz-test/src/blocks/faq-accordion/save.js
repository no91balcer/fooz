import {InnerBlocks, useBlockProps, RichText} from '@wordpress/block-editor';

export default function Save({attributes}) {
    return (
        <div {...useBlockProps.save({className: 'c-faq'})} itemscope itemtype="https://schema.org/FAQPage">
            <RichText.Content
                tagName="h2"
                className="c-faq__title"
                value={attributes.title}
            />
            <div className="c-faq__items">
                <InnerBlocks.Content/>
            </div>
        </div>
    );
}