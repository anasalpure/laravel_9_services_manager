function ArticleCard2({ article }) {
    return (
        <article className="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-3">
            <a
                href={article.source_url}
                target="_blank"
                className="block p-6 text-gray-900"
            >
                <h2 className="text-lg font-bold">{article.title}</h2>
                <date className="font-bold text-gray-500">{article.date}</date>
            </a>
        </article>
    );
}

export default ArticleCard2;
