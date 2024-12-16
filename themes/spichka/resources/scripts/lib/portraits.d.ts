export type ThemeOptionsResponse = {
  theme_portraits: {
    static_image: string;
    alt: string;
    extra_images: {extra_image: string}[];
    quotes: {quote: string}[];
  }[];
};

export type Combination = {
  staticImage: string;
  extraImage: string;
  quote: string;
  alt: string;
};
