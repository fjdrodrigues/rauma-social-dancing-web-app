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
			url: "50phNVoO6bk",
			title: "Modern Bachata",
			description: "Sol & Nasti"
		},
		{
			itemType: GalleryItemType.video,
			url: "cm5j4Zbvqag",
			title: "Modern Bachata",
			description: "Grupo Extra - Me Emborrachare con Ataca, Alemana, Daniel y Desiree"
		},
		{
			itemType: GalleryItemType.video,
			url: "LfLD5if6VEU",
			title: "Modern Bachata",
			description: "Aimane & Brigitte",
			start: 8
		}
	];

  public dominicanBachataVideos: Array<GalleryItem> = [
		{
			itemType: GalleryItemType.video,
			url: "abftct3_6Zo",
			title: "Dominican Bachata",
			description: "Christina and Junior",
			start: 16
		},
		{
			itemType: GalleryItemType.video,
			url: "6x4Nmn9RrAg",
			title: "Dominican Bachata",
			description: "Samy el Magico & Carolina",
			start: 8
		},
		{
			itemType: GalleryItemType.video,
			url: "yRZ0Lt0wb54",
			title: "Dominican Bachata",
			description: "Argenis & Carolina",
			start: 10,
			end: 183
		},
		{
			itemType: GalleryItemType.video,
			url: "MSZDfQTK1MA",
			title: "Dominican Bachata",
			description: "Oscar Nino & Carla"
		},
		{
			itemType: GalleryItemType.video,
			url: "sfmSw4lDMgw",
			title: "Dominican Bachata",
			description: "Pablo & Raquel"
		}
	];

  public sensualBachataVideos: Array<GalleryItem> = [
		{
			itemType: GalleryItemType.video,
			url: "dX8yPE_0S5k",
			title: "Sensual Bachata",
			description: "Pablo & Raquel"
		},
		{
			itemType: GalleryItemType.video,
			url: "hXL_y30Dx-s",
			title: "Sensual Bachata",
			description: "Cornel & Rithika"
		},
		{
			itemType: GalleryItemType.video,
			url: "h9SGu96YgVw",
			title: "Sensual Bachata",
			description: "Korke & Judith"
		},
		{
			itemType: GalleryItemType.video,
			url: "ogzxiPx3Isc",
			title: "Sensual Bachata",
			description: "Daniel & Desiree",
			start: 8
		}
	];
  constructor() {
  }
	
}
