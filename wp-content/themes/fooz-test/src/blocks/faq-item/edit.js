import {RichText, useBlockProps} from '@wordpress/block-editor';
import {__} from "@wordpress/i18n";

export default function Edit({attributes, setAttributes}) {
    const {question, answer} = attributes;

    return (
        <div {...useBlockProps({className: 'c-faq-item'})}>
            <div className="c-faq-item__question">
                <RichText
                    tagName="h3"
                    className="c-faq-item__question-inner"
                    value={question}
                    onChange={(val) => setAttributes({ question: val })}
                    placeholder={__('Write a question...', 'fooz-test')}
                />

                <div className="c-faq-item-icons">
                    <span className="c-faq-item__icon c-faq-item__icon--plus" aria-hidden="true"></span>
                    <span className="c-faq-item__icon c-faq-item__icon--minus" aria-hidden="true"></span>
                </div>
            </div>

            <div className="c-faq-item__answer">
                <div className="c-faq-item__answer-inner">
                    <RichText
                        tagName="div"
                        value={answer}
                        onChange={(val) => setAttributes({ answer: val })}
                        placeholder={__('Write an answer...', 'fooz-test')}
                    />
                </div>
            </div>
        </div>
    );
}