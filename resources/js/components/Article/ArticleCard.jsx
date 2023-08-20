import ExternalLink from "../shared/ExternalLink";

function ArticleCard({ article }) {
    return (
        <article className="relative bg-white overflow-hidden shadow-sm sm:rounded-lg p-3 mb-3">
            <h2 className="text-xl my-2 font-semibold text-secound-500">
                {article.title}
            </h2>

            <date className="font-bold text-gray-500">{article.date}</date>
            <div>
                <span class="bg-[#38bdf8] text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded">
                    {article.service}
                </span>
            </div>
            <ExternalLink
                href={article.source_url}
                className="inline-block right-0 bottom-0 absolute"
                title="MORE"
            />
        </article>
    );
}

export default ArticleCard;
