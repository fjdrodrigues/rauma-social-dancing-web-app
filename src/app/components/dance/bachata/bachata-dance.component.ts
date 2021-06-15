import { Component } from '@angular/core';
import { GalleryItem, GalleryItemType } from '../../shared/gallery/gallery-item.interface';

@Component({
  selector: 'bachata-dance',
  templateUrl: './bachata-dance.component.html',
  styleUrls: ['./bachata-dance.component.css']
})
export class BachataDanceComponent {
	
  public modernBachataVideos: Array<GalleryItem> = [
		{
			itemType: GalleryItemType.video,
			url: "nQnRSrjodVs",
			title: "Modern Bachata",
			description: "Adonis Santiago & Cristina Bolbat"
		}
	];

  public dominicanBachataVideos: Array<GalleryItem> = [
		{
			itemType: GalleryItemType.video,
			url: "5CLqh-pPzwQ",
			title: "Dominican Bachata",
			description: "Adonis Santiago & Cristina Bolbat"
		}
	];

  public sensualBachataVideos: Array<GalleryItem> = [
		{
			itemType: GalleryItemType.video,
			url: "5CLqh-pPzwQ",
			title: "Sensual Bachata",
			description: "Adonis Santiago & Cristina Bolbat"
		}
	];
  constructor() {
  }
	
}
