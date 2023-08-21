function ExternalLink({ title, className, ...props }) {
    return (
        <a
            className={
                className +
                " btn focus:outline-none focus:shadow-outline text-primary"
            }
            target="_blank"
            {...props}
        >
            {title}

            <svg
                className="inline w-5 h-5 m-3"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 47.52344 26.0083"
            >
                <g id="Layer_2" data-name="Layer 2">
                    <g id="Layer_1-2" data-name="Layer 1">
                        <line
                            x1="0.00006"
                            y1="13.00252"
                            x2="47.52335"
                            y2="13.00252"
                            style={{ fill: "#04ade" }}
                        />
                        <line
                            y1="13.00244"
                            x2="44.07471"
                            y2="13.00244"
                            style={{
                                fill: "none",
                                stroke: "#38bdf8",
                                strokeMiterlimit: 10,
                                strokeWidth: "3px",
                            }}
                        />
                        <polygon
                            points="33.538 26.008 31.369 23.679 42.854 13.006 31.369 2.329 33.538 0 47.523 13.006 33.538 26.008"
                            style={{ fill: "#38bdf8" }}
                        />
                    </g>
                </g>
            </svg>
        </a>
    );
}

export default ExternalLink;
