import {RichText, useBlockProps} from '@wordpress/block-editor';

export default function Save({attributes}) {
    const {question, answer} = attributes;

    return (
        <div
            {...useBlockProps.save({className: 'c-faq-item'})}
            itemprop="mainEntity"
            itemscope
            itemtype="https://schema.org/Question"
        >
            <button type="button" className="c-faq-item__question">
                <h3 itemprop="name" className="c-faq-item__question-inner">
                    <RichText.Content value={question}/>
                </h3>
                <div className="c-faq-item-icons">
                    <span className="c-faq-item__icon c-faq-item__icon--plus" aria-hidden="true"></span>
                    <span className="c-faq-item__icon c-faq-item__icon--minus" aria-hidden="true"></span>
                </div>
            </button>

            <div
                className="c-faq-item__answer"
                itemscope
                itemprop="acceptedAnswer"
                itemtype="https://schema.org/Answer"
            >
                <div itemprop="text" className="c-faq-item__answer-inner">
                    <RichText.Content value={answer}/>
                </div>
            </div>
        </div>
    );
}