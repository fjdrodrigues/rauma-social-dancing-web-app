export enum GalleryItemType {
  image = 'image',
  video = 'video'
}

export interface GalleryItem {
  itemType: GalleryItemType,
  url: string,
  title: string,
  description: string,
  start?: number,
  end?: number
}
