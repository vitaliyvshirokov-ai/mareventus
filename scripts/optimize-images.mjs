import sharp from 'sharp';
import { existsSync } from 'node:fs';

const images = [
  ['public/assets/images/vessel-01.jpg','public/assets/images/vessel-01.webp',1920],
  ['public/assets/images/vessel-02.png','public/assets/images/vessel-02.webp',1800],
  ['public/assets/images/vessel-03.png','public/assets/images/vessel-03.webp',1800],
];
for (const [input,output,width] of images) if (existsSync(input)) await sharp(input).resize({width,withoutEnlargement:true}).webp({quality:84}).toFile(output);
