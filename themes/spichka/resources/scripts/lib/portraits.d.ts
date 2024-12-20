export type ThemeOptionsResponse = {
  theme_portraits: {
    static_image: string;
    alt: string;
    extra_image: string;
    quotes: {quote: string}[];
  }[];
};

export type Portrait = {
  staticImage: string;
  alt: string;
  extraImage: string;
  quotes: string[];
};
